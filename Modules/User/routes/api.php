<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('users', UserController::class)->names('user');
});
 


 

// Route::post('/register' , [AuthController::class , 'register'])->name('regiter');

//Authentication
Route::post('/sendCode' , [AuthController::class , 'sendCode'])->name('sendCode');
Route::post('/verifyCode' , [AuthController::class , 'veriifyCode'])->name('verifyCode');
Route::post('/login' , [AuthController::class , 'login'])->name('login') ;
Route::post('/logout' , [AuthController::class , 'logout'])->middleware('auth:sanctum') ;



// ِdashboard 


Route::middleware('auth:sanctum')->prefix('dashboard')->group(function () {

    Route::get('/student/courses', [DashboardController::class, 'studentCourses'])
        ->name('dashboard.student.courses');

    Route::get('/teacher/courses', [DashboardController::class, 'teacherCourses'])
        ->name('dashboard.teacher.courses');

    Route::get('/teacher/students', [DashboardController::class, 'teacherStudents'])
        ->name('dashboard.teacher.students');

});
