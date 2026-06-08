<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\YesOrNoQuestion;

class YesOrNoQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            [
                'question' => 'Investasi saham selalu lebih berisiko daripada tabungan biasa.',
                'correct_answer' => 'yes',
                'explanation' => 'Secara umum, saham memiliki risiko lebih tinggi dibandingkan tabungan berjangka karena nilai pasar saham bisa berfluktuasi.'
            ],
            [
                'question' => 'Obligasi negara biasanya memberikan pembayaran bunga reguler.',
                'correct_answer' => 'yes',
                'explanation' => 'Obligasi memberikan kupon atau bunga berkala yang dibayarkan kepada pemegang obligasi.'
            ],
            [
                'question' => 'Reksa dana tidak pernah bisa rugi karena dikelola oleh profesional.',
                'correct_answer' => 'no',
                'explanation' => 'Meskipun dikelola profesional, nilai reksa dana tetap tergantung pada aset yang berada di dalamnya dan bisa turun.'
            ],
            [
                'question' => 'Emas adalah contoh aset safe-haven yang sering dicari ketika inflasi naik.',
                'correct_answer' => 'yes',
                'explanation' => 'Emas sering digunakan sebagai lindung nilai terhadap inflasi dan ketidakpastian pasar.'
            ],
            [
                'question' => 'Properti bisa dijual dalam hitungan menit kapan saja tanpa risiko kerugian.',
                'correct_answer' => 'no',
                'explanation' => 'Properti biasanya kurang likuid, sehingga proses jual bisa memakan waktu dan harga dapat berubah.'
            ],
            [
                'question' => 'Tabungan berjangka mendapat bunga tetap selama periode simpanan.',
                'correct_answer' => 'yes',
                'explanation' => 'Tabungan berjangka umumnya memberikan bunga tetap sampai periode tenor selesai.'
            ],
        ];

        foreach ($questions as $question) {
            YesOrNoQuestion::create($question);
        }
    }
}
