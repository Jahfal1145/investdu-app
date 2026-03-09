<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// 1. Halaman awal bawaan Laravel (biar nggak 404 saat buka 127.0.0.1:8000)
Route::get('/', function () {
    return view('welcome');
});

// 2. Jalur untuk fitur Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

// 3. Jalur untuk fitur Register
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// 4. Jalur Dashboard (hanya bisa diakses kalau sudah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// 5. Jalur untuk memproses tombol Logout
Route::post('/logout', [AuthController::class, 'logout']);