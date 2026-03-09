<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/dashboard', function () {
    return "Berhasil Login! Ini adalah halaman aman backend kamu.";
})->middleware('auth');