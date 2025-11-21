<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentApiController;
use App\Http\Controllers\Api\ClassRoomController;

use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\ExamResultController;

// Public Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // API Resource
    Route::apiResource('students', StudentApiController::class);
    // Route::apiResource('classes', ClassRoomController::class);
    Route::apiResource('classes', ClassRoomController::class);
    Route::apiResource('subjects', SubjectController::class);
    Route::apiResource('results', ExamResultController::class);
});
