<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController ;
use App\Http\Controllers\CourseController ;
use App\Http\Controllers\ChapterController ;
use App\Http\Controllers\SectionController ; 
use App\Http\Controllers\EnrollmentController ;
use App\Http\Controllers\DashboardController ;
use App\Http\Controllers\UserController ;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 

// Route::post('/register' , [AuthController::class , 'register'])->name('regiter');

//Authentication
Route::post('/sendCode' , [AuthController::class , 'sendCode'])->name('sendCode');
Route::post('/verifyCode' , [AuthController::class , 'veriifyCode'])->name('verifyCode');
Route::post('/login' , [AuthController::class , 'login'])->name('login') ;
Route::post('/logout' , [AuthController::class , 'logout'])->middleware('auth:sanctum') ;

//course

Route::post('/courses/create' , [CourseController::class , 'create'])->name('create')->middleware('auth:sanctum') ;
Route::put('/courses/{course}' , [CourseController::class , 'update'])->name('update')->middleware('auth:sanctum') ;
Route::delete('/courses/{course}' , [CourseController::class , 'delete'])->name('delete')->middleware('auth:sanctum') ;

Route::get('/courses' , [CourseController::class , 'corses'])->name('corses') ;
Route::get('/courses/{course}' , [CourseController::class , 'show'])->name('show') ;



 Route::get('/courses/{course}/content', [UserController::class, 'userCourse'])->name('course.content')->middleware('auth:sanctum');
// chapters

Route::post('/chapters/create' , [ChapterController::class , 'create'])->name('create')->middleware('auth:sanctum') ;
Route::put('/chapters/{chapter}' , [ChapterController::class , 'update'])->name('update')->middleware('auth:sanctum') ;
Route::delete('/chapters/{chapter}' , [ChapterController::class , 'delete'])->name('delete')->middleware('auth:sanctum') ;

Route::get('/chapters' , [ChapterController::class , 'index'])->name('index') ;
Route::get('/chapters/{chapter}' , [ChapterController::class , 'show'])->name('show') ;

// sections

Route::post('/sections/create' , [SectionController::class , 'create'])->name('create')->middleware('auth:sanctum') ;
Route::put('/sections/{section}' , [SectionController::class , 'update'])->name('update')->middleware('auth:sanctum') ;
Route::delete('/sections/{section}' , [SectionController::class , 'delete'])->name('delete')->middleware('auth:sanctum') ;

Route::get('/sections' , [SectionController::class , 'index'])->name('index') ;
Route::get('/sections/{section}' , [SectionController::class , 'show'])->name('show') ;

// auth to course

Route::middleware('auth:sanctum')->post('/coursess/{course}/enroll' , [EnrollmentController::class , 'store'])->name('store') ;
Route::middleware('auth:sanctum')->post('/courses/{course}/students/{student}/grant',[EnrollmentController::class, 'grant']);


// ِdashboard 


Route::middleware('auth:sanctum')->prefix('dashboard')->group(function () {

    Route::get('/student/courses', [DashboardController::class, 'studentCourses'])
        ->name('dashboard.student.courses');

    Route::get('/teacher/courses', [DashboardController::class, 'teacherCourses'])
        ->name('dashboard.teacher.courses');

    Route::get('/teacher/students', [DashboardController::class, 'teacherStudents'])
        ->name('dashboard.teacher.students');

});
