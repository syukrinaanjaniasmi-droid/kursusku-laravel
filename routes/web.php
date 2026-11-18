<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('courses', CourseController::class);

Route::get('/courses/{course}/availability', [EnrollmentController::class, 'availability'])
    ->name('courses.availability');

Route::resource('enrollments', EnrollmentController::class)
    ->only(['index', 'create', 'store']);