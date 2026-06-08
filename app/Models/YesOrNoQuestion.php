<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\InvestmentCategory;

class YesOrNoQuestion extends Model
{
    protected $fillable = ['category_id', 'question', 'correct_answer', 'explanation'];

    public function category()
    {
        return $this->belongsTo(InvestmentCategory::class, 'category_id');
    }
}
