<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('yes_or_no_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->enum('correct_answer', ['yes', 'no']);
            $table->text('explanation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('yes_or_no_questions');
    }
};
