<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogTagController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExerciseController;
use App\Http\Controllers\Admin\ExerciseOptionController;
use App\Http\Controllers\Admin\LessonsController;
use App\Http\Controllers\Admin\LevelsController;
use App\Http\Controllers\Admin\PaymentTransactionController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuizQuestionController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\SubscriptionPlanController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\VocabularyController;

Route::prefix('admin')->middleware('loginadmin')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::prefix('lesson')->group(function () {
        Route::get('/', [LessonsController::class, 'index'])->name('index');

        // Trash & soft delete
        Route::get('trash', [LessonsController::class, 'trash'])
            ->name('lesson.trash');
        Route::delete('{lesson}', [LessonsController::class, 'destroy'])->name('destroy');
        Route::get('{lesson}/delete', [LessonsController::class, 'delete'])
            ->name('lesson.delete');
        Route::get('{lesson}/restore', [LessonsController::class, 'restore'])
            ->name('lesson.restore');
        Route::delete('/{id}/force-delete', [LessonsController::class, 'forceDelete'])->name('lesson.forceDelete');

        // Toggle
        Route::post('bulk-update-access', [LessonsController::class, 'bulkUpdateAccess'])
            ->name('lesson.bulkUpdateAccess');
        Route::get('{lesson}/toggle-status', [LessonsController::class, 'toggleStatus'])
            ->name('lesson.toggleStatus');
        Route::get('{lesson}/toggle-free', [LessonsController::class, 'toggleFree'])
            ->name('lesson.toggleFree');
        // Manage vocabularies
        Route::get('{lesson}/vocabularies', [LessonsController::class, 'manageVocabularies'])
            ->name('lesson.manageVocabularies');
        Route::post('{lesson}/vocabularies', [LessonsController::class, 'addVocabularies'])
            ->name('lesson.addVocabularies');
        Route::delete('{lesson}/vocabularies/{vocabulary}', [LessonsController::class, 'removeVocabulary'])
            ->name('lesson.removeVocabulary');

    });
    Route::post(
        '{lesson}/vocabularies/import',
        [LessonsController::class, 'importVocabularies']
    )->name('lesson.importVocabularies');
    // Resource CRUD (index, create, store, show, edit, update)
    Route::resource('lesson', LessonsController::class)
        ->except(['lesson.destroy']);
    Route::prefix('vocabularies')->name('vocabularies.')->group(function () {

        Route::get('/', [VocabularyController::class, 'index'])->name('index');
        Route::get('/create', [VocabularyController::class, 'create'])->name('create');
        Route::post('/', [VocabularyController::class, 'store'])->name('store');

        // ===== IMPORT =====
        Route::get('/importExcel', [VocabularyController::class, 'showImportForm'])->name('importExcel');
        Route::post('/import', [VocabularyController::class, 'import'])->name('import');

        // ===== TRASH (PHẢI ĐẶT TRƯỚC {vocabulary}) =====
        Route::get('/trash', [VocabularyController::class, 'trash'])->name('trash');
        Route::patch('/{id}/restore', [VocabularyController::class, 'restore'])->name('restore');
        Route::delete('/{id}/force-delete', [VocabularyController::class, 'forceDelete'])->name('forceDelete');

        // ===== STATUS =====
        Route::patch('/{vocabulary}/toggle-status', [VocabularyController::class, 'toggleStatus'])->name('toggleStatus');

        // ===== CRUD THEO ID (ĐẶT SAU CÙNG) =====
        Route::get('/{vocabulary}/edit', [VocabularyController::class, 'edit'])->name('edit');
        Route::put('/{vocabulary}', [VocabularyController::class, 'update'])->name('update');
        Route::delete('/{vocabulary}', [VocabularyController::class, 'destroy'])->name('destroy');
        Route::get('/{vocabulary}', [VocabularyController::class, 'show'])->name('show');
    });

    Route::prefix('levels')->name('levels.')->group(function () {

        Route::get('/', [LevelsController::class, 'index'])->name('index');
        Route::get('/create', [LevelsController::class, 'create'])->name('create');
        Route::post('/', [LevelsController::class, 'store'])->name('store');

        // ===== TRASH =====
        Route::get('/trash', [LevelsController::class, 'trash'])->name('trash');
        Route::post('/trash/empty', [LevelsController::class, 'emptyTrash'])->name('trash.empty');
        Route::post('/{level}/restore', [LevelsController::class, 'restore'])->name('restore');
        Route::delete('/{level}/force-delete', [LevelsController::class, 'forceDelete'])->name('force-delete');

        // ===== SINGLE RESOURCE =====
        Route::get('/{level}', [LevelsController::class, 'show'])->name('show');
        Route::get('/{level}/edit', [LevelsController::class, 'edit'])->name('edit');
        Route::put('/{level}', [LevelsController::class, 'update'])->name('update');
        Route::delete('/{level}', [LevelsController::class, 'destroy'])->name('destroy');

        Route::get('{level}/toggle-status', [LevelsController::class, 'toggleStatus'])
            ->name('toggleStatus');
    });
    Route::prefix('quizzes')
        ->name('quizzes.')
        ->group(function () {

            // ===== QUIZ CRUD =====
            Route::get('/', [QuizController::class, 'index'])->name('index');
            Route::get('/create', [QuizController::class, 'create'])->name('create');
            Route::post('/', [QuizController::class, 'store'])->name('store');
            Route::get('/{quiz}', [QuizController::class, 'show'])->name('show');
            Route::get('/{quiz}/edit', [QuizController::class, 'edit'])->name('edit');
            Route::put('/{quiz}', [QuizController::class, 'update'])->name('update');
            Route::delete('/{quiz}', [QuizController::class, 'destroy'])->name('destroy');
            Route::get('{quiz}/delete', [QuizController::class, 'delete'])
                ->name('delete');

            Route::get('/{quiz}/toggle-status', [QuizController::class, 'toggleStatus'])
                ->name('toggleStatus');

            Route::get('/trash', [QuizController::class, 'trash'])->name('trash');
            Route::get('/{id}/restore', [QuizController::class, 'restore'])->name('restore');
            Route::delete('/{id}/force-delete', [QuizController::class, 'forceDelete'])->name('forceDelete');

            // ===== QUIZ QUESTIONS (NESTED) =====
            Route::prefix('{quiz}/questions')
                ->name('questions.')
                ->group(function () {

                    Route::get('/', [QuizQuestionController::class, 'index'])->name('index');
                    Route::get('/create', [QuizQuestionController::class, 'create'])->name('create');
                    Route::post('/', [QuizQuestionController::class, 'store'])->name('store');
                    Route::get('/{question}', [QuizQuestionController::class, 'show'])->name('show');

                    Route::get('/{question}/edit', [QuizQuestionController::class, 'edit'])->name('edit');
                    Route::put('/{question}', [QuizQuestionController::class, 'update'])->name('update');
                    Route::delete('/{question}', [QuizQuestionController::class, 'destroy'])->name('destroy');

                    Route::get('/trash', [QuizQuestionController::class, 'trash'])->name('trash');
                    Route::post('/{id}/restore', [QuizQuestionController::class, 'restore'])->name('restore');
                    Route::delete('/{id}/force-delete', [QuizQuestionController::class, 'forceDelete'])->name('forceDelete');
                    Route::get('{question}/delete', [QuizQuestionController::class, 'delete'])
                        ->name('delete');
                });
        });

    Route::prefix('users')->name('user.')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::get('/create', [UsersController::class, 'create'])->name('create');
        Route::post('/', [UsersController::class, 'store'])->name('store');
        Route::get('/{id}', [UsersController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UsersController::class, 'update'])->name('update');
        Route::delete('/{id}', [UsersController::class, 'delete'])->name('delete');

        // Additional actions
        Route::get('/{id}/toggle-premium', [UsersController::class, 'togglePremium'])->name('togglePremium');
        Route::post('/{id}/change-role', [UsersController::class, 'changeRole'])->name('changeRole');
        Route::post('/{id}/reset-password', [UsersController::class, 'resetPassword'])->name('resetPassword');

        // Progress & Achievements
        Route::get('/{id}/progress', [UsersController::class, 'progress'])->name('progress');
        Route::get('/{id}/achievements', [UsersController::class, 'achievements'])->name('achievements');

        // Trash
        Route::get('/trash/list', [UsersController::class, 'trash'])->name('trash');
        Route::post('/trash/{id}/restore', [UsersController::class, 'restore'])->name('restore');
        Route::delete('/trash/{id}', [UsersController::class, 'destroy'])->name('destroy');

        // Bulk & Export
        Route::post('/bulk-action', [UsersController::class, 'bulkAction'])->name('bulkAction');
        Route::get('/export', [UsersController::class, 'export'])->name('export');
    });

    Route::prefix('blog')->name('blog.')->group(function () {

        // ===== POSTS =====
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::get('create', [BlogController::class, 'create'])->name('create');
        Route::post('/', [BlogController::class, 'store'])->name('store');

        Route::get('trash', [BlogController::class, 'trash'])->name('trash');
        Route::post('bulk-action', [BlogController::class, 'bulkAction'])->name('bulk');

        Route::post('{post}/toggle-featured', [BlogController::class, 'toggleFeatured'])->name('toggle-featured');
        Route::get('{post}/toggle-published', [BlogController::class, 'togglePublished'])->name('toggle-published');

        Route::post('{id}/restore', [BlogController::class, 'restore'])->name('restore');
        Route::delete('{id}/force-delete', [BlogController::class, 'forceDelete'])->name('force-delete');

        // ===== CATEGORIES =====
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [BlogCategoryController::class, 'index'])->name('index');
            Route::post('/', [BlogCategoryController::class, 'store'])->name('store');
            Route::get('trash', [BlogCategoryController::class, 'trash'])->name('trash');

            Route::put('{category}', [BlogCategoryController::class, 'update'])->name('update');
            Route::delete('{category}', [BlogCategoryController::class, 'destroy'])->name('destroy');
            Route::post('{id}/restore', [BlogCategoryController::class, 'restore'])->name('restore');
            Route::post('reorder', [BlogCategoryController::class, 'reorder'])->name('reorder');
        });

        // ===== TAGS =====
        Route::prefix('tags')->name('tags.')->group(function () {
            Route::get('/', [BlogTagController::class, 'index'])->name('index');
            Route::post('/', [BlogTagController::class, 'store'])->name('store');
            Route::put('{tag}', [BlogTagController::class, 'update'])->name('update');
            Route::delete('{tag}', [BlogTagController::class, 'destroy'])->name('destroy');
            Route::get('search', [BlogTagController::class, 'search'])->name('search');
            Route::post('quick-create', [BlogTagController::class, 'quickCreate'])->name('quick-create');
            Route::post('merge', [BlogTagController::class, 'merge'])->name('merge');
        });

        // ===== DYNAMIC ROUTES (luôn đặt sau cùng) =====
        Route::get('{post}', [BlogController::class, 'show'])->name('show');
        Route::get('{post}/edit', [BlogController::class, 'edit'])->name('edit');
        Route::put('{post}', [BlogController::class, 'update'])->name('update');
        Route::delete('{post}', [BlogController::class, 'destroy'])->name('destroy');

    });
    // ================= EXERCISES =================
    Route::prefix('exercises')->name('exercises.')
        ->controller(ExerciseController::class)
        ->group(function () {

            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('lessons/{lesson}/vocabularies', 'getVocabularies')->name('lessons.vocabularies');
            Route::get('trash', 'trash')->name('trash');
            Route::post('{exercise}/restore', 'restore')->name('restore');
            Route::delete('{exercise}/force', 'forceDelete')->name('force');

            Route::get('{exercise}', 'show')->name('show');
            Route::get('{exercise}/edit', 'edit')->name('edit');
            Route::put('{exercise}', 'update')->name('update');
            Route::delete('{exercise}', 'destroy')->name('destroy');
        });

    // ================= EXERCISE OPTIONS =================
    Route::prefix('exercises/{exercise}/options')
        ->name('exercise.options.')
        ->group(function () {

            // TRASH
            Route::get('trash', [ExerciseOptionController::class, 'trash'])->name('trash');
            Route::put('{option}/restore', [ExerciseOptionController::class, 'restore'])->name('restore');
            Route::delete('{option}/force-delete', [ExerciseOptionController::class, 'forceDelete'])->name('forceDelete');

            // CRUD
            Route::get('/', [ExerciseOptionController::class, 'index'])->name('index');
            Route::get('create', [ExerciseOptionController::class, 'create'])->name('create');
            Route::post('/', [ExerciseOptionController::class, 'store'])->name('store');

            Route::get('{option}', [ExerciseOptionController::class, 'show'])->name('show');
            Route::get('{option}/edit', [ExerciseOptionController::class, 'edit'])->name('edit');
            Route::put('{option}', [ExerciseOptionController::class, 'update'])->name('update');
            Route::delete('{option}', [ExerciseOptionController::class, 'destroy'])->name('destroy');
        });
    // ================= SUBSCRIPTION PLANS =================
    Route::prefix('subscription-plans')->name('subscription-plans.')
        ->controller(SubscriptionPlanController::class)
        ->group(function () {

            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');

            // Trash
            Route::get('trash', 'trash')->name('trash');
            Route::post('{id}/restore', 'restore')->name('restore');
            Route::delete('{id}/force-delete', 'forceDelete')->name('forceDelete');

            // Toggle
            Route::get('{subscriptionPlan}/toggle-active', 'toggleActive')->name('toggleActive');

            // CRUD (đặt sau cùng)
            Route::get('{subscriptionPlan}', 'show')->name('show');
            Route::get('{subscriptionPlan}/edit', 'edit')->name('edit');
            Route::put('{subscriptionPlan}', 'update')->name('update');
            Route::delete('{subscriptionPlan}', 'destroy')->name('destroy');
        });

    // ================= SUBSCRIPTIONS =================
    Route::prefix('subscriptions')->name('subscriptions.')
        ->controller(SubscriptionController::class)
        ->group(function () {

            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');

            // Trash
            Route::get('trash', 'trash')->name('trash');
            Route::post('{id}/restore', 'restore')->name('restore');
            Route::delete('{id}/force-delete', 'forceDelete')->name('forceDelete');

            // Actions
            Route::put('{subscription}/cancel', 'cancel')->name('cancel');
            Route::post('{subscription}/extend', 'extend')->name('extend');
            Route::post('check-expired', 'checkExpired')->name('checkExpired');

            // Bulk actions
            Route::post('bulk-action', 'bulkAction')->name('bulkAction');
            Route::get('export', 'export')->name('export');

            // Stats
            Route::get('expiring-soon', 'expiringSoon')->name('expiringSoon');
            Route::get('revenue-report', 'revenueReport')->name('revenueReport');

            // CRUD (đặt sau cùng)
            Route::get('{subscription}', 'show')->name('show');
            Route::get('{subscription}/edit', 'edit')->name('edit');
            Route::put('{subscription}', 'update')->name('update');
            Route::delete('{subscription}', 'destroy')->name('destroy');
        });

    // ================= PAYMENT TRANSACTIONS =================
    Route::prefix('transactions')->name('transactions.')
        ->controller(PaymentTransactionController::class)
        ->group(function () {

            Route::get('/', 'index')->name('index');

            // Routes mới cho approve/reject
            Route::post('{transaction}/approve', 'approve')->name('approve');
            Route::post('{transaction}/reject', 'reject')->name('reject');
            Route::delete('{transaction}/proof', 'deleteProof')->name('deleteProof');
            Route::get('{id}/proof-image', 'showProofImage')->name('proof.image');

            // Stats & Reports
            Route::get('stats', 'stats')->name('stats');
            Route::get('export', 'export')->name('export');
            Route::get('revenue-by-month', 'revenueByMonth')->name('revenueByMonth');

            // Trash
            Route::get('trash', 'trash')->name('trash');
            Route::post('{id}/restore', 'restore')->name('restore');
            Route::delete('{id}/force-delete', 'forceDelete')->name('forceDelete');

            // Actions
            Route::post('{transaction}/update-status', 'updateStatus')->name('updateStatus');
            Route::post('{transaction}/refund', 'refund')->name('refund');
            Route::post('bulk-action', 'bulkAction')->name('bulkAction');

            // CRUD (đặt sau cùng)
            Route::get('{transaction}', 'show')->name('show');
            Route::delete('{transaction}', 'destroy')->name('destroy');
        });

});

// Phần khai báo ngoài group admin
Route::get('admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'dologin'])->name('admin.dologin');
Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
