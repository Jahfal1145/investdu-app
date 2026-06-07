<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TriviaQuestion extends Model
{
    protected $fillable = [
        'question', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer', 'explanation'
    ];
}