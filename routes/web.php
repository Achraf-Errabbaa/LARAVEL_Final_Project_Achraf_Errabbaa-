<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserController;
use App\Models\Lesson;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [CourseController::class, 'index2'])->name('home.home');



Route::get('/course', [CourseController::class, 'index'])->name('coach.course');
Route::post('/course/store', [CourseController::class, 'store'])->name('coach.store');


Route::get('/course/lesson/{course}', [LessonController::class, 'lessonView'])->name('course.lessons');
Route::get('/courses/lessons/{course}', [LessonController::class, 'index'])->name('coach.lesson');
Route::post('/courses/lessons/{course}', [LessonController::class, 'store'])->name('lessons.store');
Route::delete('/lesson/{lesson}', [LessonController::class, 'destroy'])->name('lesson.destroy');

Route::resource("calendar" , CalendarController::class);


Route::middleware([ 'auth','coach'])->group(function () {
    
});

Route::get('/class', [ClassController::class, 'index'])->name('coach.class');
Route::post('/class/store', [ClassController::class, 'store'])->name('classes.store');
Route::delete('/classes/{class}', [ClassController::class, 'destroy'])->name('classes.destroy');
Route::get('/class/courses/{class}', [ClassController::class, 'viewCourses'])->name('class.courses');
Route::get('/class/classes/{class}', [ClassController::class, 'viewClasses'])->name('class.classes');

Route::post('/classes/enroll', [ClassController::class, 'enroll'])->name('classes.enroll');

// Route::post('/classes/assign-student', [ClassController::class, 'assignStudent'])->name('classes.assign-student');
// Route::post('/class/assign-student', [ClassController::class, 'assignStudent'])->name('class.assignStudent');
// Route::post('/classes/{class}/enroll', [ClassController::class, 'enroll'])->name('classes.enroll');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/approve', [AdminController::class, 'index'])->name('admin.approve.index');
    Route::patch('admin/approve/{user}', [AdminController::class, 'approve'])->name('admin.approve');
    Route::delete('admin/reject/{user}', [AdminController::class, 'reject'])->name('admin.reject');
    Route::put('admin/giverole/{user}', [AdminController::class, 'giveRole'])->name('admin.role');
});


    
Route::get('user/classes', [ClassController::class, 'viewClass'])->name('user.classes');


Route::get('/dashboard',[CourseController::class, 'index2'], function () {
    return view('dashboard',) ;
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
