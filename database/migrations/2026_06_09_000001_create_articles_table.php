<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            // Ini dia biang keroknya! Kolom yang hilang:
            $table->foreignId('category_id')->constrained('investment_categories')->cascadeOnDelete();
            
            $table->string('title');
            $table->string('slug');
            $table->text('excerpt')->nullable();
            $table->longText('body');
            $table->string('thumbnail')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
}

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};