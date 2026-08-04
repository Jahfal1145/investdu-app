<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom diisi kecuali ID (biar aman dari perbedaan versi Git)
    protected $guarded = ['id'];

    // Relasi ke Kategori Investasi (karena di tabel temanmu ada category_id)
    public function category()
    {
        return $this->belongsTo(InvestmentCategory::class, 'category_id');
    }

    // Relasi ke User (jika artikel mencatat siapa penulisnya)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}