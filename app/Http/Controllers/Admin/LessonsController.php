<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\Vocabulary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Lesson::with(['level'])
            ->withCount([
                'vocabularies' => function ($q) {
                    $q->whereNull('vocabulary.deleted_at');
                },
            ])
            ->orderBy('display_order', 'asc')
            ->orderBy('created_at', 'desc');

        // Filter by level
        if ($request->has('level_id') && $request->level_id != '') {
            $query->where('level_id', $request->level_id);
        }

        // Filter by status
        if ($request->has('is_active') && $request->is_active != '') {
            $query->where('is_active', $request->is_active);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                    ->orWhere('topic', 'like', '%'.$request->search.'%');
            });
        }

        $list = $query->paginate(10);
        $levels = Level::where('is_active', true)->orderBy('display_order')->get();

        return view('admin.lesson.index', compact('list', 'levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = Level::where('is_active', true)->orderBy('display_order')->get();

        return view('admin.lesson.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequest $request)
    {
        $lesson = new Lesson;
        $lesson->level_id = $request->level_id;
        $lesson->title = $request->title;
        $lesson->topic = $request->topic;
        $lesson->description = $request->description;
        $lesson->display_order = $request->display_order ?? 0;
        $lesson->is_free = $request->has('is_free') ? 1 : 0;
        $lesson->is_active = $request->is_active ?? 1;
        $lesson->save();

        return redirect()->route('lesson.index')->with('success', 'Thêm bài học thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lesson = Lesson::with([
            'level',
            'vocabularies',
        ])->withCount('vocabularies')->findOrFail($id);

        $stats = [
            'total_vocabularies' => $lesson->vocabularies_count,
            'total_students' => $lesson->completions()->distinct('user_id')->count(),
            'completion_rate' => $lesson->completions()->where('is_completed', true)->count(),
        ];

        return view('admin.lesson.show', compact('lesson', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lesson = Lesson::findOrFail($id);
        $levels = Level::where('is_active', true)->orderBy('display_order')->get();

        return view('admin.lesson.edit', compact('lesson', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonRequest $request, string $id)
    {
        $lesson = Lesson::findOrFail($id);

        $lesson->level_id = $request->level_id;
        $lesson->title = $request->title;
        $lesson->topic = $request->topic;
        $lesson->description = $request->description;
        $lesson->display_order = $request->display_order ?? $lesson->display_order;
        $lesson->is_free = $request->has('is_free') ? 1 : 0;
        $lesson->is_active = $request->is_active ?? $lesson->is_active;
        $lesson->save();

        return redirect()->route('lesson.index')->with('success', 'Cập nhật bài học thành công');
    }

    /**
     * Display a listing of trashed resources.
     */
    public function trash()
    {
        $list = Lesson::onlyTrashed()
            ->with('level')
            ->orderBy('deleted_at', 'desc')
            ->paginate(10);

        return view('admin.lesson.trash', compact('list'));
    }

    /**
     * Restore a soft-deleted resource.
     */
    public function restore(string $id)
    {
        $lesson = Lesson::withTrashed()->findOrFail($id);
        $lesson->restore();

        return redirect()->route('lesson.trash')->with('success', 'Khôi phục bài học thành công');
    }

    /**
     * Soft delete lesson
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return back()->with('success', 'Bài học đã được đưa vào thùng rác');
    }

    public function forceDelete(string $id)
    {
        $lesson = Lesson::withTrashed()->findOrFail($id);
        $lesson->vocabularies()->detach();
        $lesson->forceDelete();

        return redirect()->route('lesson.trash')
            ->with('success', 'Xóa vĩnh viễn bài học thành công');
    }

    public function delete(string $id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return redirect()->route('lesson.index')->with('success', 'Xóa bài học thành công');
    }

    /**
     * Toggle the status of a lesson (active/inactive).
     */
    public function toggleStatus(string $id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->is_active = ! $lesson->is_active;
        $lesson->save();

        $status = $lesson->is_active ? 'kích hoạt' : 'vô hiệu hóa';

        return redirect()->route('lesson.index')->with('success', "Đã {$status} bài học thành công");
    }

    /**
     * Toggle free status of a lesson.
     */
    public function toggleFree(string $id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->is_free = ! $lesson->is_free;
        $lesson->save();

        $status = $lesson->is_free ? 'miễn phí' : 'trả phí';

        return redirect()->route('lesson.index')->with('success', "Đã chuyển bài học sang {$status}");
    }

    /**
     * Update display order.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:lessons,id',
            'orders.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->orders as $order) {
            Lesson::where('id', $order['id'])->update(['display_order' => $order['order']]);
        }

        return response()->json(['success' => true, 'message' => 'Cập nhật thứ tự thành công']);
    }

    /**
     * Manage vocabularies for a lesson.
     */
    public function manageVocabularies(string $id)
    {
        $lesson = Lesson::with(['vocabularies', 'level'])->findOrFail($id);

        // Lấy danh sách từ vựng chưa có trong bài học này
        $availableVocabularies = \App\Models\Vocabulary::whereNotIn('id',
            $lesson->vocabularies()->pluck('vocabulary.id')
        )->where('is_active', true)->get();

        return view('admin.lesson.vocabularies', compact('lesson', 'availableVocabularies'));
    }

    /**
     * Add vocabularies to lesson.
     */
    public function addVocabularies(Request $request, string $id)
    {
        $request->validate([
            'vocabulary_ids' => 'required|array',
            'vocabulary_ids.*' => 'exists:vocabulary,id',
        ]);

        $lesson = Lesson::findOrFail($id);

        $startOrder = $lesson->vocabularies()->count();

        foreach ($request->vocabulary_ids as $index => $vocabId) {
            $lesson->vocabularies()->attach($vocabId, [
                'display_order' => $startOrder + $index + 1, // ✅ BẮT ĐẦU TỪ 1
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Cập nhật word_count
        $lesson->save();

        return redirect()->route('lesson.manageVocabularies', $id)
            ->with('success', 'Thêm từ vựng vào bài học thành công');
    }

    // public function importVocabularies(Request $request, Lesson $lesson)
    // {
    //     $request->validate([
    //         'file' => 'required|file|mimes:xlsx,xls,csv',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         $spreadsheet = IOFactory::load($request->file('file')->getPathname());
    //         $rows = $spreadsheet->getActiveSheet()->toArray();

    //         // Dòng đầu là header → bỏ
    //         unset($rows[0]);

    //         $inserted = 0;

    //         foreach ($rows as $row) {
    //             // Mapping cột
    //             [$word, $pronunciation, $wordType, $meaningVi, $meaningEn] = $row;

    //             if (! $word || ! $meaningVi) {
    //                 continue;
    //             }

    //             // Tránh trùng từ
    //             $vocabulary = Vocabulary::firstOrCreate(
    //                 ['word' => trim($word)],
    //                 [
    //                     'pronunciation' => $pronunciation,
    //                     'word_type' => $wordType,
    //                     'meaning_vi' => $meaningVi,
    //                     'meaning_en' => $meaningEn,
    //                     'is_active' => true,
    //                 ]
    //             );

    //             // Gắn vào bài học (nếu chưa có)
    //             if (! $lesson->vocabularies->contains($vocabulary->id)) {
    //                 $lesson->vocabularies()->attach($vocabulary->id);
    //                 $inserted++;
    //             }
    //         }

    //         // Cập nhật số lượng từ
    //         $lesson->update([
    //             'word_count' => $lesson->vocabularies()->count(),
    //         ]);

    //         DB::commit();

    //         return redirect()
    //             ->route('lesson.manageVocabularies', $lesson->id)
    //             ->with('success', "Import thành công {$inserted} từ vựng");

    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         return back()->withErrors([
    //             'file' => 'Lỗi import: '.$e->getMessage(),
    //         ]);
    //     }
    // }
    public function importVocabularies(Request $request, Lesson $lesson)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        DB::beginTransaction();

        try {
            /* ================= LOAD FILE ================= */
            $spreadsheet = IOFactory::load($request->file('file')->getPathname());
            $rows = $spreadsheet->getActiveSheet()->toArray();

            if (count($rows) < 2) {
                throw new \Exception('File Excel không có dữ liệu');
            }

            /* ================= VALIDATE HEADER ================= */
            $expectedHeader = ['word', 'pronunciation', 'word_type', 'meaning_vi', 'meaning_en'];

            // Chuẩn hóa header từ Excel
            $header = array_map(fn ($cell) => strtolower(trim((string) $cell)), $rows[0]);

            // Kiểm tra từng cột
            foreach ($expectedHeader as $i => $col) {
                if (! isset($header[$i]) || $header[$i] !== $col) {
                    throw new \Exception(
                        'File Excel không đúng định dạng cột ở cột '.($i + 1).
                        '. Thứ tự đúng: '.implode(', ', $expectedHeader)
                    );
                }
            }

            // Bỏ header
            array_shift($rows);

            /* ================= VALIDATE DUPLICATE IN FILE ================= */
            $wordsInFile = [];

            foreach ($rows as $index => $row) {
                $word = strtolower(trim($row[0] ?? ''));

                if ($word === '') {
                    throw new \Exception('Dòng '.($index + 2).' thiếu từ vựng');
                }

                if (in_array($word, $wordsInFile)) {
                    throw new \Exception("Từ '{$row[0]}' bị trùng trong file Excel");
                }

                $wordsInFile[] = $word;
            }

            /* ================= VALIDATE DUPLICATE IN DATABASE ================= */
            $existingWords = Vocabulary::whereIn('word', $wordsInFile)
                ->pluck('word')
                ->map(fn ($w) => strtolower($w))
                ->toArray();

            /* ================= IMPORT DATA ================= */
            foreach ($rows as $row) {
                $vocab = Vocabulary::create([
                    'word' => trim($row[0]),
                    'pronunciation' => $row[1] ?? null,
                    'word_type' => $row[2] ?? null,
                    'meaning_vi' => $row[3],
                    'meaning_en' => $row[4] ?? null,
                    'is_active' => true,
                ]);

                $lesson->vocabularies()->attach($vocab->id, [
                    'display_order' => $lesson->vocabularies()->count(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            /* ================= UPDATE WORD COUNT ================= */

            DB::commit();

            return redirect()
                ->route('lesson.manageVocabularies', $lesson->id)
                ->with('success', 'Import từ vựng thành công');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors([
                'file' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove vocabulary from lesson.
     */
    public function removeVocabulary(string $lessonId, string $vocabularyId)
    {
        $lesson = Lesson::findOrFail($lessonId);
        $lesson->vocabularies()->detach($vocabularyId);

        $lesson->save();

        return redirect()->route('lesson.manageVocabularies', $lessonId)
            ->with('success', 'Xóa từ vựng khỏi bài học thành công');
    }

    /**
     * Duplicate a lesson.
     */
    public function duplicate(string $id)
    {
        $originalLesson = Lesson::with('vocabularies')->findOrFail($id);

        $newLesson = $originalLesson->replicate();
        $newLesson->title = $originalLesson->title.' (Copy)';
        $newLesson->display_order = Lesson::max('display_order') + 1;
        $newLesson->created_at = now();
        $newLesson->save();

        // Copy vocabularies
        $vocabularies = $originalLesson->vocabularies->mapWithKeys(function ($vocab) {
            return [$vocab->id => [
                'display_order' => $vocab->pivot->display_order,
                'created_at' => now(),
                'updated_at' => now(),
            ]];
        });

        $newLesson->vocabularies()->attach($vocabularies);

        return redirect()->route('lesson.edit', $newLesson->id)
            ->with('success', 'Sao chép bài học thành công');
    }

    /**
     * Bulk actions.
     */
    public function bulkUpdateAccess(Request $request)
    {
        $validated = $request->validate([
            'lesson_ids' => 'required|array',
            'lesson_ids.*' => 'exists:lessons,id',
            'is_free' => 'required|boolean',
        ]);

        Lesson::whereIn('id', $validated['lesson_ids'])
            ->update(['is_free' => $validated['is_free']]);

        $type = $validated['is_free'] ? 'miễn phí' : 'premium';
        $count = count($validated['lesson_ids']);

        return back()->with('success', "Đã cập nhật {$count} bài học thành {$type}!");
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,activate,deactivate,set_free,set_paid',
            'lesson_ids' => 'required|array',
            'lesson_ids.*' => 'exists:lessons,id',
        ]);

        $lessons = Lesson::whereIn('id', $request->lesson_ids);

        switch ($request->action) {
            case 'delete':
                $lessons->delete();
                $message = 'Xóa các bài học thành công';
                break;
            case 'activate':
                $lessons->update(['is_active' => true]);
                $message = 'Kích hoạt các bài học thành công';
                break;
            case 'deactivate':
                $lessons->update(['is_active' => false]);
                $message = 'Vô hiệu hóa các bài học thành công';
                break;
            case 'set_free':
                $lessons->update(['is_free' => true]);
                $message = 'Chuyển các bài học sang miễn phí thành công';
                break;
            case 'set_paid':
                $lessons->update(['is_free' => false]);
                $message = 'Chuyển các bài học sang trả phí thành công';
                break;
            default:
                $message = 'Hành động không hợp lệ';
        }

        return redirect()->route('lesson.index')->with('success', $message);
    }
}
