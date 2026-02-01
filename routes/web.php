<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminDonorController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\ForgotPasswordController;

Route::get('/test', function () {
    return 'Laravel OK';
});

Route::get('/', [HomeController::class, 'index']);

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

Route::get('/donate', [DonorController::class, 'showForm'])->name('donate');
Route::post('/donors', [DonorController::class, 'store'])->middleware('auth')->name('donors.store');

// Blood request routes
Route::get('/request', [App\Http\Controllers\BloodRequestController::class, 'showForm'])->name('blood.request');
Route::post('/request', [App\Http\Controllers\BloodRequestController::class, 'store'])->middleware('auth')->name('blood.request.store');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration with OTP verification
Route::get('register', [OtpController::class, 'showRegisterForm'])->name('register');
Route::post('register', [OtpController::class, 'sendOtp'])->name('register.send-otp');
Route::get('verify-otp', [OtpController::class, 'showVerifyForm'])->name('otp.verify.form');
Route::post('verify-otp', [OtpController::class, 'verifyOtp'])->name('otp.verify');
Route::post('resend-otp', [OtpController::class, 'resendOtp'])->name('otp.resend');

// Forgot Password routes
Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetOtp'])->name('password.email');
Route::get('forgot-password/verify-otp', [ForgotPasswordController::class, 'showVerifyOtpForm'])->name('password.verify.otp.form');
Route::post('forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verify.otp');
Route::post('forgot-password/resend-otp', [ForgotPasswordController::class, 'resendOtp'])->name('password.resend.otp');
Route::get('reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

// Profile routes (protected by auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Profile update OTP verification
    Route::get('/profile/verify-otp', [ProfileController::class, 'showVerifyOtpForm'])->name('profile.verify.otp.form');
    Route::post('/profile/verify-otp', [ProfileController::class, 'verifyOtpAndUpdate'])->name('profile.verify.otp');
    Route::post('/profile/resend-otp', [ProfileController::class, 'resendProfileOtp'])->name('profile.resend.otp');

    // Delete account with OTP verification
    Route::post('/profile/delete', [ProfileController::class, 'initiateDestroy'])->name('profile.delete.initiate');
    Route::get('/profile/delete/verify-otp', [ProfileController::class, 'showDeleteOtpForm'])->name('profile.delete.otp.form');
    Route::post('/profile/delete/verify-otp', [ProfileController::class, 'verifyOtpAndDestroy'])->name('profile.delete.otp.verify');
    Route::post('/profile/delete/resend-otp', [ProfileController::class, 'resendDeleteOtp'])->name('profile.delete.resend.otp');

    // Donation history
    Route::get('/my-donations', function () {
        return view('user.donationHistory');
    })->name('donation.history');
});

// Admin routes
Route::get('/admin-login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin-login', [AdminLoginController::class, 'adminLogin'])->name('admin.login.submit');
Route::post('/admin-logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// Admin dashboard (protected)
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/donors', [AdminDashboardController::class, 'donors'])->name('admin.donors');
    Route::get('/admin/requests', [AdminDashboardController::class, 'requests'])->name('admin.requests');
    Route::get('/admin/blood-inventory', [AdminDashboardController::class, 'bloodInventory'])->name('admin.blood-inventory');

    // Blood stock routes
    Route::post('/admin/blood-stock/add', [AdminDashboardController::class, 'addBloodStock'])->name('admin.blood-stock.add');

    // Blood request status routes
    Route::post('/admin/requests/{id}/update-status', [AdminDashboardController::class, 'updateRequestStatus'])->name('admin.requests.update-status');

    // Donor approval routes
    Route::post('/admin/donors/{id}/approve', [AdminDonorController::class, 'approve'])->name('admin.donors.approve');
    Route::post('/admin/donors/{id}/reject', [AdminDonorController::class, 'reject'])->name('admin.donors.reject');
    Route::post('/admin/donors/{id}/reset', [AdminDonorController::class, 'resetStatus'])->name('admin.donors.reset');

    // Bulk actions
    Route::post('/admin/donors/bulk-action', [AdminDonorController::class, 'bulkAction'])->name('admin.donors.bulk');
});
