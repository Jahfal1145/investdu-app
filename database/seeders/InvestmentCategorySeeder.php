<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InvestmentCategory;
use Illuminate\Support\Str;

class InvestmentCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Tabungan Berjangka',
                'icon' => 'piggy-bank',
                'description' => 'Simpanan dengan bunga flat berjangka yang aman dari fluktuasi pasar.',
                'badge' => 'Risiko Rendah'
            ],
            [
                'name' => 'Saham',
                'icon' => 'trending-up',
                'description' => 'Miliki porsi kepemilikan di perusahaan publik terkemuka untuk pertumbuhan modal jangka panjang.',
                'badge' => 'Populer'
            ],
            [
                'name' => 'Reksa Dana',
                'icon' => 'users',
                'description' => 'Diversifikasi instan dikelola oleh Manajer Investasi profesional untuk pemula.',
                'badge' => 'Rekomendasi'
            ],
            [
                'name' => 'Obligasi',
                'icon' => 'file-text',
                'description' => 'Surat utang negara atau korporasi yang memberikan kupon return berkala secara aman.',
                'badge' => 'Stabil'
            ],
            [
                'name' => 'Properti',
                'icon' => 'home',
                'description' => 'Investasi aset fisik tanah dan bangunan dengan potensi capital gain tinggi.',
                'badge' => 'Jangka Panjang'
            ],
            [
                'name' => 'Emas',
                'icon' => 'award',
                'description' => 'Aset safe-haven terbaik pelindung kekayaan dari gerusan nilai inflasi.',
                'badge' => 'Tahan Inflasi'
            ],
            [
                'name' => 'Crypto',
                'icon' => 'cpu',
                'description' => 'Aset digital masa depan dengan teknologi blockchain untuk profit volatilitas tinggi.',
                'badge' => 'Baru ✨'
            ],
        ];

        foreach ($categories as $cat) {
            InvestmentCategory::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'icon' => $cat['icon'],
                'description' => $cat['description'],
                'badge' => $cat['badge'],
            ]);
        }
    }
}