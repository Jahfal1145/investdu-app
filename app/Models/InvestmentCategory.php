<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TriviaQuestion;
use App\Models\YesOrNoQuestion;

class InvestmentCategory extends Model
{
    protected $fillable = ['name', 'slug', 'icon', 'description', 'badge'];

    public function triviaQuestions()
    {
        return $this->hasMany(TriviaQuestion::class, 'category_id');
    }

    public function yesOrNoQuestions()
    {
        return $this->hasMany(YesOrNoQuestion::class, 'category_id');
    }
}