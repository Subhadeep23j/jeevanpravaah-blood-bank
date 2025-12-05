<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminDonorController;
use App\Http\Controllers\ApiController;

Route::get('/status', function () {
    return response()->json(['status' => 'OK']);
});

Route::post('/login', [ApiController::class, 'login']);
Route::get('/alluser', [ApiController::class, 'getAllData']);
