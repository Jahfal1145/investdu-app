<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            
            // 1. Induknya (Kategori) WAJIB diciptakan lebih dulu!
            InvestmentCategorySeeder::class,
            
            // 2. Baru anak-anaknya (Soal) dimasukkan
            YesOrNoQuestionSeeder::class,
            TriviaQuestionSeeder::class,
            
            // 3. Seeder tambahan lainnya
            FaqSeeder::class,
        ]);
    }
}