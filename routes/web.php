<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\Web\ClassRoomController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\VerificationController;

// Homepage
Route::get('/', function () {
    return Inertia::render('welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

// Dashboard (auth + verified)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

// Students Routes (Web CRUD)
Route::resource('students', StudentController::class); // index, create, store, show, edit, update, destroy

// ClassRooms Routes (Web CRUD)
Route::prefix('classes')->name('class_rooms.')->group(function () {
    Route::get('/', [ClassRoomController::class, 'index'])->name('index');
    Route::get('/create', [ClassRoomController::class, 'create'])->name('create');
    Route::post('/', [ClassRoomController::class, 'store'])->name('store');
    Route::get('/{classRoom}/edit', [ClassRoomController::class, 'edit'])->name('edit');
    Route::put('/{classRoom}', [ClassRoomController::class, 'update'])->name('update');
    Route::delete('/{classRoom}', [ClassRoomController::class, 'destroy'])->name('destroy');
});

// Blade Auth pages (Web)
Route::get('/register', fn() => view('auth.register'))->name('register.page');
Route::get('/login', fn() => view('auth.login'))->name('login.page');

// Web Form Submit
Route::post('/register', [RegistrationController::class, 'register'])->name('register.submit');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Email verification (Web)
Route::get('/verify/{id}', [VerificationController::class, 'verify'])->name('verify');

// Additional settings
require __DIR__.'/settings.php';
