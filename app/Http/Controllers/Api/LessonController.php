<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * GET /api/lessons
     * Danh sách tất cả lessons (có phân trang, filter)
     */
    public function index(Request $request)
    {
        $query = Lesson::where('is_active', true)
            ->with('level:id,level_name');

        // Filter by level
        if ($request->filled('level_id')) {
            $query->where('level_id', $request->level_id);
        }

        // Filter by access type (free/premium)
        if ($request->filled('access_type')) {
            if ($request->access_type === 'free') {
                $query->where('is_free', true);
            } elseif ($request->access_type === 'premium') {
                $query->where('is_free', false);
            }
        }

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        // Sort
        $sortBy = $request->get('sort_by', 'display_order');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $lessons = $query->withCount([
            'vocabularies as word_count' => function ($q) {
                $q->where('vocabulary.is_active', true);
            },
        ])->paginate($request->get('per_page', 20));

        // Thêm thông tin access cho từng lesson nếu user đã login
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => $lessons->map(function ($lesson) use ($user) {
                return [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'topic' => $lesson->topic,
                    'description' => $lesson->description,
                    'word_count' => $lesson->word_count,
                    'is_free' => $lesson->is_free,
                    'level' => $lesson->level,
                    'has_access' => $user ? $user->canAccessLesson($lesson) : $lesson->is_free,
                    'requires_premium' => ! $lesson->is_free,
                ];
            }),
            'pagination' => [
                'current_page' => $lessons->currentPage(),
                'last_page' => $lessons->lastPage(),
                'per_page' => $lessons->perPage(),
                'total' => $lessons->total(),
            ],
        ]);
    }

    /**
     * GET /api/lessons/{id}
     * Chi tiết lesson + vocabularies
     */
    public function show(Request $request, $id)
    {
        $lesson = Lesson::where('is_active', true)
            ->with([
                'level:id,level_name',
                'vocabularies' => function ($q) {
                    $q->where('vocabulary.is_active', true)
                        ->orderBy('lesson_vocabulary.display_order')
                        ->select([
                            'vocabulary.id',
                            'vocabulary.word',
                            'vocabulary.pronunciation',
                            'vocabulary.word_type',
                            'vocabulary.meaning_vi',
                            'vocabulary.meaning_en',
                        ]);
                },
            ])
            ->withCount([
                'vocabularies as word_count' => function ($q) {
                    $q->where('vocabulary.is_active', true);
                },
        ])
            ->findOrFail($id);

        // 🔑 LẤY USER ĐÚNG CÁCH (KHÔNG PHỤ THUỘC middleware)
        $user = $request->user('sanctum');

        // Kiểm tra quyền truy cập
        $hasAccess = $lesson->is_free
            || ($user && $user->canAccessLesson($lesson));

        // ❌ Không có quyền
        if (! $hasAccess) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng ký Premium để truy cập bài học này',
                'data' => [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'topic' => $lesson->topic,
                    'description' => $lesson->description,
                    'word_count' => $lesson->word_count,
                    'is_free' => $lesson->is_free,
                    'level' => $lesson->level,
                    'requires_premium' => true,
                    'has_access' => false,
                ],
            ], 403);
        }

        // ✅ Có quyền truy cập
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $lesson->id,
                'title' => $lesson->title,
                'topic' => $lesson->topic,
                'description' => $lesson->description,
                'word_count' => $lesson->word_count,
                'is_free' => $lesson->is_free,
                'level' => $lesson->level,
                'has_access' => true,
                'vocabularies' => $lesson->vocabularies->map(function ($vocab) {
                    return [
                        'id' => $vocab->id,
                        'word' => $vocab->word,
                        'pronunciation' => $vocab->pronunciation,
                        'word_type' => $vocab->word_type,
                        'meaning_vi' => $vocab->meaning_vi,
                        'meaning_en' => $vocab->meaning_en,
                        'order' => $vocab->pivot->display_order,
                    ];
                }),
            ],
        ]);
    }

    /**
     * GET /api/lessons/free/list
     * Danh sách lessons miễn phí
     */
    public function freeLessons(Request $request)
    {
        $query = Lesson::where('is_active', true)
            ->where('is_free', true)
            ->with('level:id,level_name');

        // Filter by level
        if ($request->filled('level_id')) {
            $query->where('level_id', $request->level_id);
        }

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        $lessons = $query->withCount([
            'vocabularies as word_count' => function ($q) {
                $q->where('vocabulary.is_active', true);
            },
        ])
            ->orderBy('display_order')
            ->paginate($request->get('per_page', 20));

        return response()->json([
            'success' => true,
            'data' => $lessons->map(function ($lesson) {
                return [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'topic' => $lesson->topic,
                    'description' => $lesson->description,
                    'word_count' => $lesson->word_count,
                    'is_free' => true,
                    'level' => $lesson->level,
                ];
            }),
            'pagination' => [
                'current_page' => $lessons->currentPage(),
                'last_page' => $lessons->lastPage(),
                'per_page' => $lessons->perPage(),
                'total' => $lessons->total(),
            ],
        ]);
    }

    /**
     * GET /api/lessons/premium/list
     * Danh sách lessons premium
     */
    public function premiumLessons(Request $request)
    {
        $query = Lesson::where('is_active', true)
            ->where('is_free', false)
            ->with('level:id,level_name');

        // Filter by level
        if ($request->filled('level_id')) {
            $query->where('level_id', $request->level_id);
        }

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        $lessons = $query->withCount([
            'vocabularies as word_count' => function ($q) {
                $q->where('vocabulary.is_active', true);
            },
        ])
            ->orderBy('display_order')
            ->paginate($request->get('per_page', 20));

        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => $lessons->map(function ($lesson) use ($user) {
                return [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'topic' => $lesson->topic,
                    'description' => $lesson->description,
                    'word_count' => $lesson->word_count,
                    'is_free' => false,
                    'level' => $lesson->level,
                    'has_access' => $user ? $user->canAccessLesson($lesson) : false,
                    'requires_premium' => true,
                ];
            }),
            'pagination' => [
                'current_page' => $lessons->currentPage(),
                'last_page' => $lessons->lastPage(),
                'per_page' => $lessons->perPage(),
                'total' => $lessons->total(),
            ],
        ]);
    }

    /**
     * GET /api/lessons/{id}/access-check
     * Kiểm tra quyền truy cập lesson
     */
    public function checkAccess(Request $request, $id)
    {
        $lesson = Lesson::where('is_active', true)->findOrFail($id);
        $user = $request->user();

        // Guest
        if (! $user) {
            return response()->json([
                'success' => true,
                'data' => [
                    'has_access' => $lesson->is_free,
                    'is_free' => $lesson->is_free,
                    'requires_login' => ! $lesson->is_free,
                    'requires_premium' => ! $lesson->is_free,
                    'message' => $lesson->is_free
                        ? 'Bài học miễn phí'
                        : 'Vui lòng đăng nhập để truy cập bài học này',
                ],
            ]);
        }

        // Logged in
        $hasAccess = $user->canAccessLesson($lesson);

        return response()->json([
            'success' => true,
            'data' => [
                'has_access' => $hasAccess,
                'is_free' => $lesson->is_free,
                'user_is_premium' => $user->isPremium(),
                'premium_expires_at' => $user->premium_expires_at,
                'requires_premium' => ! $lesson->is_free && ! $user->isPremium(),
                'message' => $hasAccess
                    ? 'Bạn có quyền truy cập bài học này'
                    : 'Bạn cần đăng ký Premium để truy cập bài học này',
            ],
        ]);
    }

    /**
     * GET /api/lessons/by-level/{level_id}
     * Lấy lessons theo level
     */
    public function byLevel(Request $request, $levelId)
    {
        $lessons = Lesson::where('is_active', true)
            ->where('level_id', $levelId)
            ->with('level:id,level_name')
            ->withCount([
                'vocabularies as word_count' => function ($q) {
                    $q->where('vocabulary.is_active', true);
                },
            ])
            ->orderBy('display_order')
            ->get();

        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => $lessons->map(function ($lesson) use ($user) {
                return [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'topic' => $lesson->topic,
                    'description' => $lesson->description,
                    'word_count' => $lesson->word_count,
                    'is_free' => $lesson->is_free,
                    'level' => $lesson->level,
                    'has_access' => $user ? $user->canAccessLesson($lesson) : $lesson->is_free,
                ];
            }),
        ]);
    }

    /**
     * GET /api/lessons/{id}/preview
     * Xem trước lesson (chỉ 5 từ đầu tiên cho premium lessons)
     */
    public function preview($id)
    {
        $lesson = Lesson::where('is_active', true)
            ->with([
                'level:id,level_name',
                'vocabularies' => function ($q) {
                    $q->where('vocabulary.is_active', true)
                        ->orderBy('lesson_vocabulary.display_order')
                        ->limit(5) // Chỉ lấy 5 từ đầu
                        ->select([
                            'vocabulary.id',
                            'vocabulary.word',
                            'vocabulary.pronunciation',
                            'vocabulary.word_type',
                            'vocabulary.meaning_vi',
                        ]);
                },
            ])
            ->withCount([
                'vocabularies as word_count' => function ($q) {
                    $q->where('vocabulary.is_active', true);
                },
            ])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $lesson->id,
                'title' => $lesson->title,
                'topic' => $lesson->topic,
                'description' => $lesson->description,
                'word_count' => $lesson->word_count,
                'is_free' => $lesson->is_free,
                'level' => $lesson->level,
                'is_preview' => ! $lesson->is_free,
                'preview_vocabularies' => $lesson->vocabularies->map(function ($vocab) {
                    return [
                        'id' => $vocab->id,
                        'word' => $vocab->word,
                        'pronunciation' => $vocab->pronunciation,
                        'word_type' => $vocab->word_type,
                        'meaning_vi' => $vocab->meaning_vi,
                    ];
                }),
                'message' => ! $lesson->is_free
                    ? 'Đây là bản xem trước. Đăng ký Premium để xem đầy đủ.'
                    : null,
            ],
        ]);
    }

    /**
     * GET /api/lessons/search
     * Tìm kiếm lessons
     */
    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:2',
        ]);

        $query = $request->get('q');

        $lessons = Lesson::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', '%'.$query.'%')
                    ->orWhere('topic', 'like', '%'.$query.'%')
                    ->orWhere('description', 'like', '%'.$query.'%');
            })
            ->with('level:id,level_name')
            ->withCount([
                'vocabularies as word_count' => function ($q) {
                    $q->where('vocabulary.is_active', true);
                },
            ])
            ->orderBy('display_order')
            ->limit(20)
            ->get();

        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => $lessons->map(function ($lesson) use ($user) {
                return [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'topic' => $lesson->topic,
                    'description' => $lesson->description,
                    'word_count' => $lesson->word_count,
                    'is_free' => $lesson->is_free,
                    'level' => $lesson->level,
                    'has_access' => $user ? $user->canAccessLesson($lesson) : $lesson->is_free,
                ];
            }),
        ]);
    }
}
