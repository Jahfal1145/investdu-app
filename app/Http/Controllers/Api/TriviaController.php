<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TriviaQuestion;
use Illuminate\Http\Request;

class TriviaController extends Controller
{
    public function getQuestions(Request $request)
    {
        $query = TriviaQuestion::query();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // Ambil maksimal 20 soal secara acak (random)
        $questions = $query->inRandomOrder()->limit(20)->get();

        // Kembalikan dalam bentuk REST API (JSON)
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil soal trivia',
            'data' => $questions
        ]);
    }
}