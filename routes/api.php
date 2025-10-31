<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\ClassRoomController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\ExamResultController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::apiResource('students', StudentController::class);
    Route::apiResource('classes', ClassRoomController::class);
    Route::apiResource('subjects', SubjectController::class);
    Route::apiResource('results', ExamResultController::class);
});
