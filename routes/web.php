<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\Api\StudentController;

use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;


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


// Blade view pages
Route::get('/register', fn() => view('auth.register'))->name('register.page');
Route::get('/login', fn() => view('auth.login'))->name('login.page');

// Form submit
Route::post('/register', [RegistrationController::class, 'register'])->name('register.submit');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Email verification
// Route::get('/verify/{token}', [VerificationController::class, 'verify'])->name('verify');
Route::get('/verify/{id}', [VerificationController::class, 'verify'])->name('verify');

require __DIR__.'/settings.php';
