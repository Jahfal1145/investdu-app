<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController; // <-- INI YANG BIKIN ERROR KALAU KETINGGALAN

// --- AREA HALAMAN AWAL & LOGIN ---
Route::get('/', function () {
    return view('home');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
// --- AREA LOGIN GOOGLE ---
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// --- AREA DASHBOARD USER BIASA ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout']);

// --- AREA KHUSUS ADMIN ---
Route::get('/admin', [AdminController::class, 'dashboard'])->middleware('auth');
Route::get('/admin/users', [AdminController::class, 'index'])->middleware('auth');
Route::post('/admin/users/{id}/delete', [AdminController::class, 'destroy'])->middleware('auth');

Route::get('/admin/users', [AdminController::class, 'index'])->middleware('auth');

// TAMBAHKAN 2 BARIS INI UNTUK FITUR EDIT
Route::get('/admin/users/{id}/edit', [AdminController::class, 'edit'])->middleware('auth');
Route::put('/admin/users/{id}/update', [AdminController::class, 'update'])->middleware('auth');

Route::post('/admin/users/{id}/delete', [AdminController::class, 'destroy'])->middleware('auth');
// Rute untuk user mengedit profilnya sendiri via popup
Route::put('/user/profile/update', [AuthController::class, 'updateProfile'])->middleware('auth');