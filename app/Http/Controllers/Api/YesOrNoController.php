<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\YesOrNoQuestion; 
use Illuminate\Http\Request;

// Perhatikan baris di bawah ini, namanya wajib YesOrNoController!
class YesOrNoController extends Controller
{
    public function getQuestions()
    {
        $questions = YesOrNoQuestion::inRandomOrder()->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil soal Yes or No',
            'data' => $questions
        ]);
    }
}