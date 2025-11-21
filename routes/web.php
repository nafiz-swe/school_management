<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\Web\ClassRoomController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;

// Homepage
Route::get('/', function () {
    return Inertia::render('welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

// Dashboard (auth + verified)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

// Students Routes (Web)
Route::resource('students', StudentController::class); // || jodi 7ta method use korite chai
// Route::prefix('students')->name('students.')->group(function () {
//     Route::get('/', [StudentController::class, 'index'])->name('index'); // list all students
//     Route::get('/create', [StudentController::class, 'create'])->name('create'); // show create form
//     Route::post('/', [StudentController::class, 'store'])->name('store'); // store new student
//     Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('edit'); // show edit form
//     Route::put('/{id}', [StudentController::class, 'update'])->name('update'); // update student
//     Route::delete('/{id}', [StudentController::class, 'destroy'])->name('destroy'); // delete student
// });

// ClassRooms Routes (Web)
Route::prefix('classes')->name('class_rooms.')->group(function () {
    Route::get('/', [ClassRoomController::class, 'index'])->name('index'); // list all classes
    Route::get('/create', [ClassRoomController::class, 'create'])->name('create'); // show create form
    Route::post('/', [ClassRoomController::class, 'store'])->name('store'); // store new class
    Route::get('/{classRoom}/edit', [ClassRoomController::class, 'edit'])->name('edit'); // show edit form
    Route::put('/{classRoom}', [ClassRoomController::class, 'update'])->name('update'); // update class
    Route::delete('/{classRoom}', [ClassRoomController::class, 'destroy'])->name('destroy'); // delete class
});

// Blade Auth pages
Route::get('/register', fn() => view('auth.register'))->name('register.page');
Route::get('/login', fn() => view('auth.login'))->name('login.page');

// Form submit
Route::post('/register', [RegistrationController::class, 'register'])->name('register.submit');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Email verification
Route::get('/verify/{id}', [VerificationController::class, 'verify'])->name('verify');

// Additional settings
require __DIR__.'/settings.php';
