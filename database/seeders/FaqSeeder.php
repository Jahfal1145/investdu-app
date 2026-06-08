<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apa itu InvestEdu?',
                'answer' => 'InvestEdu adalah platform edukasi interaktif yang membantu kamu belajar investasi dari nol, mulai dari reksa dana, saham, hingga aset crypto dengan fitur simulasi dan komunitas.'
            ],
            [
                'question' => 'Apakah fitur komunitas dan forum ini gratis?',
                'answer' => 'Ya! 100% gratis. Kamu bisa berdiskusi, bertanya, dan berbagi wawasan investasi dengan sesama member di ruang obrolan yang sudah kami sediakan.'
            ],
            [
                'question' => 'Bagaimana cara mulai berinvestasi jika modal saya kecil?',
                'answer' => 'Kamu bisa memulai dengan instrumen minim risiko seperti Reksa Dana Pasar Uang atau Tabungan Berjangka yang bisa dimulai hanya dengan Rp10.000 hingga Rp100.000 saja.'
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}