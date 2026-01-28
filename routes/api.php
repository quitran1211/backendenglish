<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\DictionaryController;
use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\QuizQuestionController;
use App\Http\Controllers\Api\QuizResultController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\SubscriptionPlanController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserLessonProgressController;
use App\Http\Controllers\Api\VocabularyController;
use App\Http\Controllers\ChatbotController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Không cần đăng nhập)
|--------------------------------------------------------------------------
*/

// ===== AUTH =====
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ===== DICTIONARY =====
Route::middleware('throttle:30,1')->get('/dictionary', [DictionaryController::class, 'search']);

// ===== LEVELS =====
Route::get('/levels', [LevelController::class, 'index']);
Route::get('/levels/{id}', [LevelController::class, 'show']);

// ===== LESSONS (PUBLIC INFO) =====
Route::get('/lessons', [LessonController::class, 'index']);
Route::get('/lessons/free/list', [LessonController::class, 'freeLessons']);
Route::get('/lessons/premium/list', [LessonController::class, 'premiumLessons']);
Route::get('/lessons/by-level/{levelId}', [LessonController::class, 'byLevel']);
Route::get('/lessons/{id}/preview', [LessonController::class, 'preview']);
Route::get('/lessons/search', [LessonController::class, 'search']);
Route::get('/lessons/{id}', [LessonController::class, 'show']);

// ===== BLOG =====
Route::prefix('blog')->group(function () {
    Route::get('posts', [BlogController::class, 'index']);
    Route::get('posts/{slug}', [BlogController::class, 'show']);
    Route::get('categories', [BlogController::class, 'categories']);
    Route::get('tags', [BlogController::class, 'tags']);
    Route::get('popular', [BlogController::class, 'popular']);
    Route::get('featured', [BlogController::class, 'featured']);
    Route::get('related/{slug}', [BlogController::class, 'related']);
    Route::post('posts/{slug}/view', [BlogController::class, 'increaseView']);
});

// ===== SUBSCRIPTION PLANS =====
Route::prefix('subscription-plans')->group(function () {
    Route::get('/', [SubscriptionPlanController::class, 'index']);
    Route::get('/{id}', [SubscriptionPlanController::class, 'show']);
});
// ===== CHATBOT =====
Route::prefix('chatbot')->group(function () {
    Route::post('/chat', [ChatbotController::class, 'chat']);
    Route::get('/conversations', [ChatbotController::class, 'getConversations']);
    Route::get('/conversations/{id}', [ChatbotController::class, 'getConversationHistory']);
    Route::delete('/conversations/{id}', [ChatbotController::class, 'deleteConversation']);
    Route::get('/stats', [ChatbotController::class, 'getStats']);
});
/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (Cần đăng nhập)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    // ===== AUTH / PROFILE =====
    // ===== AUTH / PROFILE =====
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [UserController::class, 'me']); // ✅ SỬA TỪ AuthController → UserController
    Route::put('/profile', [UserController::class, 'updateProfile']); // ✅ SỬA
    Route::post('/profile/update', [UserController::class, 'updateProfile']); // ✅ THÊM route POST

    // ===== LESSON ACCESS =====
    Route::get('/lessons/{id}/access-check', [LessonController::class, 'checkAccess']);

    // ===== VOCABULARY =====
    Route::get('/vocabularies/{id}', [VocabularyController::class, 'show']);
    Route::get('/lessons/{lessonId}/vocabularies', [VocabularyController::class, 'getByLesson']);

    // ===== PROGRESS =====
    Route::prefix('progress')->group(function () {
        Route::post('/complete-lesson', [UserLessonProgressController::class, 'markCompleted']);
        Route::get('/completed-lessons', [UserLessonProgressController::class, 'completedLessons']);
        Route::get('/my-stats', [UserLessonProgressController::class, 'myStats']);
    });

    // ===== QUIZZES =====
    Route::prefix('quizzes')->group(function () {
        Route::get('/', [QuizController::class, 'index']);
        Route::get('/{id}', [QuizController::class, 'show']);
        Route::get('/{quiz_id}/questions', [QuizQuestionController::class, 'index']);
        Route::post('/{quiz_id}/submit', [QuizQuestionController::class, 'submit']);
    });

    // ===== QUIZ RESULTS =====
    Route::prefix('quiz-results')->group(function () {
        Route::post('/save', [QuizResultController::class, 'saveResult']);
        Route::get('/history', [QuizResultController::class, 'getHistory']);
        Route::get('/detail', [QuizResultController::class, 'getDetail']);
        Route::get('/stats', [QuizResultController::class, 'getStats']);
        Route::get('/check', [QuizResultController::class, 'checkCompleted']);
        Route::get('/vocabulary-errors', [QuizResultController::class, 'getVocabularyErrors']);
    });

    // ===== EXERCISES =====
    Route::prefix('exercises')->group(function () {
        Route::get('/', [ExerciseController::class, 'index']);
        Route::post('/submit', [ExerciseController::class, 'submit']);
        Route::post('/generate', [ExerciseController::class, 'generate']);
    });

    // ===== SUBSCRIPTIONS =====
    Route::prefix('subscriptions')->group(function () {
        Route::get('/my/premium-status', [SubscriptionController::class, 'premiumStatus']);

        Route::post('purchase', [SubscriptionController::class, 'purchase']);
        Route::post('{id}/cancel', [SubscriptionController::class, 'cancel']);
        Route::post('{id}/renew', [SubscriptionController::class, 'renew']);
        Route::get('my-current', [SubscriptionController::class, 'myCurrent']);
    });

    // ===== PAYMENTS =====
    Route::prefix('payments')->group(function () {
        Route::post('create', [PaymentController::class, 'create']);
        Route::post('verify', [PaymentController::class, 'verify']);
        Route::get('history', [PaymentController::class, 'history']);
        Route::get('{transactionCode}/status', [PaymentController::class, 'checkStatus']);
        Route::post('{transactionCode}/upload-proof', [PaymentController::class, 'uploadProof']);

    });
});
