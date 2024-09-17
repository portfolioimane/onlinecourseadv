<?php

use Illuminate\Support\Facades\Route;
// routes/web.php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\LessonController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\EnrollmentController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\CategoryController;

use App\Http\Controllers\Backend\UserController as BackendUserController;
use App\Http\Controllers\Backend\CategoryController as BackendCategoryController;
use App\Http\Controllers\Backend\CourseController as BackendCourseController;
use App\Http\Controllers\Backend\LessonController as BackendLessonController;
use App\Http\Controllers\Backend\EnrollmentController as BackendEnrollmentController;
use App\Http\Controllers\Backend\PaymentController as BackendPaymentController;
use App\Http\Controllers\Backend\DashboardController;

Auth::routes();
// Admin routes

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // User management
    Route::resource('admin/users', BackendUserController::class)
        ->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'show' => 'admin.users.show',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]);

    // Category management
    Route::resource('admin/categories', BackendCategoryController::class)
        ->names([
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'show' => 'admin.categories.show',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ]);

    // Course management
    Route::resource('admin/courses', BackendCourseController::class)
        ->names([
            'index' => 'admin.courses.index',
            'create' => 'admin.courses.create',
            'store' => 'admin.courses.store',
            'show' => 'admin.courses.show',
            'edit' => 'admin.courses.edit',
            'update' => 'admin.courses.update',
            'destroy' => 'admin.courses.destroy',
        ]);

    // Lesson management
    Route::resource('admin/lessons', BackendLessonController::class)
        ->names([
            'index' => 'admin.lessons.index',
            'create' => 'admin.lessons.create',
            'store' => 'admin.lessons.store',
            'show' => 'admin.lessons.show',
            'edit' => 'admin.lessons.edit',
            'update' => 'admin.lessons.update',
            'destroy' => 'admin.lessons.destroy',
        ]);

    // Enrollment management
    Route::resource('admin/enrollments', BackendEnrollmentController::class)
        ->names([
            'index' => 'admin.enrollments.index',
            'create' => 'admin.enrollments.create',
            'store' => 'admin.enrollments.store',
            'show' => 'admin.enrollments.show',
            'edit' => 'admin.enrollments.edit',
            'update' => 'admin.enrollments.update',
            'destroy' => 'admin.enrollments.destroy',
        ]);

    // Payment management
    Route::resource('admin/payments', BackendPaymentController::class)
        ->names([
            'index' => 'admin.payments.index',
            'create' => 'admin.payments.create',
            'store' => 'admin.payments.store',
            'show' => 'admin.payments.show',
            'edit' => 'admin.payments.edit',
            'update' => 'admin.payments.update',
            'destroy' => 'admin.payments.destroy',
        ]);
});




    Route::get('/', [HomeController::class, 'index'])->name('frontend.home');

    // Category routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('frontend.categories.index');

    // Course routes
   Route::get('/courses', [CourseController::class, 'index'])->name('frontend.courses.index');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('frontend.courses.show');
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('frontend.courses.enroll');


Route::get('courses/{course}/lessons', [CourseController::class, 'showLessons'])->name('frontend.courses.lessons');


    // Lesson routes
    Route::get('/courses/{course}/lessons/{lesson}', [LessonController::class, 'show'])->name('frontend.lessons.show');

    // User profile routes
    Route::get('/profile', [UserController::class, 'show'])->name('frontend.profile.show');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('frontend.profile.edit');
    Route::post('/profile/update', [UserController::class, 'update'])->name('frontend.profile.update');

    // Enrollment routes
    Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('frontend.enrollments.index');

    // Payment routes
    Route::get('/courses/{course}/payment', [PaymentController::class, 'create'])->name('frontend.payments.create');
    Route::post('/courses/{course}/payment', [PaymentController::class, 'store'])->name('frontend.payments.store');



