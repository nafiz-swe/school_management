<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Api\StudentApiController;
use App\Http\Controllers\Api\ClassRoomController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\ExamResultController;

// Public Auth APIs (Mobile/Web App)
Route::post('/register', [ApiAuthController::class, 'register']); // Register API
Route::post('/login', [ApiAuthController::class, 'login']);       // Login API

// Protected APIs (Token required: Sanctum)
Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', [ApiAuthController::class, 'logout']); // Logout API

    // API Resources
    Route::apiResource('students', StudentApiController::class); // CRUD Students
    Route::apiResource('classes', ClassRoomController::class);   // CRUD Classes
    Route::apiResource('subjects', SubjectController::class);    // CRUD Subjects
    Route::apiResource('results', ExamResultController::class);  // CRUD Exam Results
});
