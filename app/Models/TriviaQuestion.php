<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\InvestmentCategory;

class TriviaQuestion extends Model
{
    protected $fillable = [
        'category_id', 'question', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer', 'explanation'
    ];

    public function category()
    {
        return $this->belongsTo(InvestmentCategory::class, 'category_id');
    }
}