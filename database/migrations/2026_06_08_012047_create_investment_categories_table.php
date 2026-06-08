<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('investment_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');         // Misal: "Saham", "Emas"
            $table->string('slug');         // Misal: "saham", "emas" (buat URL)
            $table->string('icon');         // Menyimpan nama kelas ikon SVG / Lucide
            $table->text('description');    // Deskripsi singkat di kartu
            $table->string('badge')->nullable(); // Misal: "Populer", "Risiko Rendah"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investment_categories');
    }
};
