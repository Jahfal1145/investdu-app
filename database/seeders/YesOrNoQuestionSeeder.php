<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\YesOrNoQuestion;
use App\Models\InvestmentCategory;

class YesOrNoQuestionSeeder extends Seeder
{
    public function run(): void
    {
        // Kita ambil kategori investasi pertama buat nyambungin Relasi Database-nya (Foreign Key)
        $category = InvestmentCategory::first();
        $categoryId = $category ? $category->id : 1;

        $soal = [
            [
                'question' => 'Investasi saham selalu lebih berisiko daripada menabung di celengan ayam.',
                'correct_answer' => 'yes',
                'explanation' => 'Benar! Saham punya fluktuasi harga yang tinggi (High Risk), sedangkan tabungan biasa nilainya tetap.',
                'category_id' => $categoryId
            ],
            [
                'question' => 'Kita butuh modal minimal Rp 10 Juta untuk mulai investasi Reksa Dana.',
                'correct_answer' => 'no',
                'explanation' => 'Salah! Di era digital sekarang, banyak Reksa Dana yang bisa dibeli mulai dari Rp 10.000 saja.',
                'category_id' => $categoryId
            ],
            [
                'question' => 'Crypto adalah instrumen investasi yang dijamin 100% aman oleh pemerintah.',
                'correct_answer' => 'no',
                'explanation' => 'Salah! Aset Kripto sangat fluktuatif dan tidak dijamin kerugiannya oleh negara, meski perdagangannya diawasi oleh Bappebti.',
                'category_id' => $categoryId
            ]
        ];

        foreach ($soal as $item) {
            // Kita pakai updateOrCreate biar datanya nggak dobel kalau kamu nge-seed 2 kali
            YesOrNoQuestion::updateOrCreate(
                ['question' => $item['question']], 
                $item
            );
        }
    }
}