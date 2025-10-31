<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\Api\StudentController;

Route::get('/', function () {
    return Inertia::render('welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});


Route::get('/students/create', [StudentController::class, 'createForm']);
Route::post('/students/create', [StudentController::class, 'storeFromForm']);
Route::get('students', [\App\Http\Controllers\Api\StudentController::class, 'showStudents']);

require __DIR__.'/settings.php';
