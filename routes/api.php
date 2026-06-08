<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TriviaController;


Route::get('/user', function (Request $request) {
    return $request->user();
    })->middleware('auth:sanctum');
    
    
Route::get('/trivia/questions', [TriviaController::class, 'getQuestions']);
Route::get('/yes-or-no/questions', [\App\Http\Controllers\Api\YesOrNoController::class, 'getQuestions']);