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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('investment_categories')->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->text('excerpt')->nullable();        // Ringkasan pendek
            $table->longText('body');                    // Isi konten artikel
            $table->string('thumbnail')->nullable();     // Path gambar thumbnail
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->unique(['category_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
