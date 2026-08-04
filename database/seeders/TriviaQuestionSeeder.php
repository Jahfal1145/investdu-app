<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TriviaQuestion; // Pastikan modelmu namanya ini

class TriviaQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $soal = [
            [
                'question' => 'Apa instrumen investasi yang paling minim risiko?',
                'option_a' => 'Saham',
                'option_b' => 'Crypto',
                'option_c' => 'Reksa Dana Pasar Uang',
                'option_d' => 'Properti',
                'correct_answer' => 'C',
                'explanation' => 'Reksa Dana Pasar Uang berisiko paling rendah karena dananya ditempatkan pada instrumen pasar uang seperti deposito yang pergerakannya stabil.'
            ],
            [
                'question' => 'Apa kepanjangan dari IHSG?',
                'option_a' => 'Indeks Harga Saham Gabungan',
                'option_b' => 'Ikatan Harga Saham Global',
                'option_c' => 'Indeks Hasil Saham Gabungan',
                'option_d' => 'Investasi Harga Saham Gabungan',
                'correct_answer' => 'A',
                'explanation' => 'IHSG (Indeks Harga Saham Gabungan) adalah grafik pengukur kinerja semua saham yang tercatat di Bursa Efek Indonesia.'
            ]
        ];

        foreach ($soal as $item) {
            TriviaQuestion::create($item);
        }
    }
}