<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TriviaQuestion;
use App\Models\InvestmentCategory;

class TriviaQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $cryptoId = InvestmentCategory::where('name', 'Crypto')->value('id') ?? 1;
        $sahamId = InvestmentCategory::where('name', 'Saham')->value('id') ?? $cryptoId;
        $emasId = InvestmentCategory::where('name', 'Emas')->value('id') ?? $cryptoId;
        $questions = [
            [
                'question' => 'Aset crypto manakah yang dikenal sebagai "Raja Crypto" dan merupakan cryptocurrency pertama di dunia?',
                'option_a' => 'Ethereum (ETH)',
                'option_b' => 'Bitcoin (BTC)',
                'option_c' => 'Solana (SOL)',
                'option_d' => 'Ripple (XRP)',
                'correct_answer' => 'B',
                'explanation' => 'Bitcoin (BTC) diciptakan pada tahun 2009 oleh Satoshi Nakamoto dan merupakan cryptocurrency pertama sekaligus terbesar di dunia berdasarkan kapitalisasi pasar.',
                'category_id' => $cryptoId,
            ],
            [
                'question' => 'Apa yang dimaksud dengan "Diversifikasi" dalam dunia investasi?',
                'option_a' => 'Menaruh semua modal hanya pada satu aset yang paling untung',
                'option_b' => 'Meminjam uang ke bank untuk membeli saham',
                'option_c' => 'Menyebarkan modal ke beberapa jenis aset berbeda untuk mengurangi risiko',
                'option_d' => 'Menjual seluruh aset ketika pasar sedang turun drastis',
                'correct_answer' => 'C',
                'explanation' => 'Diversifikasi adalah strategi membagi modal ke berbagai instrumen investasi (seperti saham, emas, deposito) dengan prinsip "Don\'t put all your eggs in one basket" untuk meminimalisir risiko kerugian.'
            ],
            [
                'question' => 'Manakah di bawah ini yang termasuk jenis investasi dengan risiko paling rendah namun imbal hasilnya cenderung stabil?',
                'option_a' => 'Saham Gorengan',
                'option_b' => 'Perdagangan Berjangka Kripto',
                'option_c' => 'Emas Batangan / Logam Mulia',
                'option_d' => 'Non-Fungible Token (NFT)',
                'correct_answer' => 'C',
                'explanation' => 'Emas batangan dikategorikan sebagai aset safe-haven yang memiliki risiko rendah, tahan terhadap inflasi, dan nilainya cenderung stabil dalam jangka panjang.',
                'category_id' => $emasId,
            ]
        ];

        foreach ($questions as $q) {
            TriviaQuestion::create($q);
        }
    }
}