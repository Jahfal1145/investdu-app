<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Models\InvestmentCategory;

Route::get('/', function () {
    // Ambil semua kategori dari database
    $categories = InvestmentCategory::all();
    
    // Kirim data ke file view home.blade.php
    return view('home', compact('categories'));
});

Route::get('/categories/{slug}', function ($slug) {
    $category = InvestmentCategory::where('slug', $slug)->firstOrFail();
    return view('category', compact('category'));
})->name('categories.show');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
// --- AREA LOGIN GOOGLE ---
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->middleware('guest');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->middleware('guest');

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
Route::get('/admin/literasi', [AdminController::class, 'literasiIndex'])->middleware('auth');
Route::get('/admin/literasi/{id}/edit', [AdminController::class, 'literasiEdit'])->middleware('auth');
Route::put('/admin/literasi/{id}/update', [AdminController::class, 'literasiUpdate'])->middleware('auth');

Route::post('/admin/literasi/{category}/trivia', [AdminController::class, 'storeCategoryTrivia'])->middleware('auth');
Route::put('/admin/literasi/{category}/trivia/{id}', [AdminController::class, 'updateCategoryTrivia'])->middleware('auth');
Route::post('/admin/literasi/{category}/trivia/{id}/delete', [AdminController::class, 'deleteCategoryTrivia'])->middleware('auth');
Route::post('/admin/literasi/{category}/yes-or-no', [AdminController::class, 'storeCategoryYesOrNo'])->middleware('auth');
Route::put('/admin/literasi/{category}/yes-or-no/{id}', [AdminController::class, 'updateCategoryYesOrNo'])->middleware('auth');
Route::post('/admin/literasi/{category}/yes-or-no/{id}/delete', [AdminController::class, 'deleteCategoryYesOrNo'])->middleware('auth');

Route::get('/admin/monitor-game', [AdminController::class, 'monitorGame'])->middleware('auth');
Route::post('/admin/monitor-game/trivia', [AdminController::class, 'storeTrivia'])->middleware('auth');
Route::put('/admin/monitor-game/trivia/{id}', [AdminController::class, 'updateTrivia'])->middleware('auth');
Route::post('/admin/monitor-game/trivia/{id}/delete', [AdminController::class, 'deleteTrivia'])->middleware('auth');
Route::post('/admin/monitor-game/yes-or-no', [AdminController::class, 'storeYesOrNo'])->middleware('auth');
Route::put('/admin/monitor-game/yes-or-no/{id}', [AdminController::class, 'updateYesOrNo'])->middleware('auth');
Route::post('/admin/monitor-game/yes-or-no/{id}/delete', [AdminController::class, 'deleteYesOrNo'])->middleware('auth');

// Rute untuk user mengedit profilnya sendiri via popup
Route::put('/user/profile/update', [AuthController::class, 'updateProfile'])->middleware('auth');

Route::get('/trivia', function () {
    return view('trivia.index');
});

Route::get('/yes-or-no', function () {
    return view('yes_or_no');
});