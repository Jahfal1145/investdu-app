<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TriviaQuestion;
use Illuminate\Http\Request;

class TriviaController extends Controller
{
    public function getQuestions()
    {
        // Ambil maksimal 20 soal secara acak (random)
        $questions = TriviaQuestion::inRandomOrder()->limit(20)->get();

        // Kembalikan dalam bentuk REST API (JSON)
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil soal trivia',
            'data' => $questions
        ]);
    }
}