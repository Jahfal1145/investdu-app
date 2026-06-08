<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\YesOrNoQuestion;

class YesOrNoController extends Controller
{
    public function getQuestions()
    {
        $questions = YesOrNoQuestion::inRandomOrder()->limit(20)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil soal yes or no',
            'data' => $questions
        ]);
    }
}
