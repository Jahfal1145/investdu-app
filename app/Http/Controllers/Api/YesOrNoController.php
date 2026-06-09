<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\YesOrNoQuestion;
use Illuminate\Http\Request;

class YesOrNoController extends Controller
{
    public function getQuestions(Request $request)
    {
        $query = YesOrNoQuestion::query();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        $questions = $query->inRandomOrder()->limit(20)->get();

        \App\Models\GameSession::create(['game_type' => 'yesorno']);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil soal yes or no',
            'data' => $questions
        ]);
    }
}
