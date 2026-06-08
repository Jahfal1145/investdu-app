<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YesOrNoQuestion extends Model
{
    protected $fillable = ['question', 'correct_answer', 'explanation'];
}
