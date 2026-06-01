<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@investdu.com'],
            [
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );
    }
}
