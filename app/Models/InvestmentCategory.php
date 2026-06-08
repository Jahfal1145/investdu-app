<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestmentCategory extends Model
{
    protected $fillable = ['name', 'slug', 'icon', 'description', 'badge'];
}