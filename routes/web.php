<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminLoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

use App\Http\Controllers\DonorController;

Route::get('/donate', function () {
    return view('donate');
})->name('donate');
Route::post('/donors', [DonorController::class, 'store'])->middleware('auth')->name('donors.store');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration routes
Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.store');

// Profile routes (protected by auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

// Admin routes
Route::get('/admin-login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin-login', [AdminLoginController::class, 'adminLogin'])->name('admin.login.submit');
Route::post('/admin-logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// Admin dashboard (protected)
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.admin-dashboard');
    })->name('admin.dashboard');
});
