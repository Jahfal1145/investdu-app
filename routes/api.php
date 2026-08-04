<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TriviaController;
use App\Http\Controllers\Api\YesOrNoController; // Tambahkan import ini biar rapi

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rute Game (URL diperpendek biar gampang ngetesnya)
Route::get('/trivia', [TriviaController::class, 'getQuestions']);
Route::get('/yes-or-no', [YesOrNoController::class, 'getQuestions']);