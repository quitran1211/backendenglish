<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\DictionaryController;
use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\QuizQuestionController;
use App\Http\Controllers\Api\QuizResultController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserLessonProgressController;
use App\Http\Controllers\Api\VocabularyController;
use Illuminate\Support\Facades\Route;

Route::post('/user', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('throttle:30,1')->get(
    '/dictionary',
    [DictionaryController::class, 'search']
);
Route::get('/levels', [LevelController::class, 'index']);
Route::get('/levels/{id}', [LevelController::class, 'show']);
Route::get('/lessons/{id}', [LessonController::class, 'show']);

Route::get('vocabularies/{id}', [VocabularyController::class, 'show']);
Route::get('lessons/{lessonId}/vocabularies', [VocabularyController::class, 'getByLesson']);

Route::prefix('quizzes')->group(function () {
    Route::get('/', [QuizController::class, 'index']);          // Lấy danh sách quiz
    Route::get('/{id}', [QuizController::class, 'show']);       // Chi tiết quiz
    Route::get('/{quiz_id}/questions', [QuizQuestionController::class, 'index']); // Lấy câu hỏi
    Route::post('/{quiz_id}/submit', [QuizQuestionController::class, 'submit']); // Submit kết quả
});

Route::prefix('progress')->group(function () {
    Route::post('/complete-lesson', [UserLessonProgressController::class, 'markCompleted']);
    Route::get('/completed-lessons', [UserLessonProgressController::class, 'completedLessons']);
});
Route::prefix('quiz-results')->group(function () {
    Route::post('/save', [QuizResultController::class, 'saveResult']);
    Route::get('/history', [QuizResultController::class, 'getHistory']);
    Route::get('/detail', [QuizResultController::class, 'getDetail']);
    Route::get('/stats', [QuizResultController::class, 'getStats']);
    Route::get('/check', [QuizResultController::class, 'checkCompleted']);
    Route::get('/vocabulary-errors', [QuizResultController::class, 'getVocabularyErrors']);
});
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
Route::prefix('profile')->group(function () {
    Route::get('users/{userId}', [ProfileController::class, 'showByUserId']);
    Route::post('users/{userId}', [ProfileController::class, 'updateByUserId']);
});
Route::prefix('exercises')->group(function () {
    Route::get('/', [ExerciseController::class, 'index']);          // ?lesson_id=1
    Route::post('/submit', [ExerciseController::class, 'submit']);

    // optional
    Route::post('/generate', [ExerciseController::class, 'generate']);
});
