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
        Schema::create('ftw_ms_questions', function (Blueprint $table) {
            $table->id('que_id');
            $table->foreignId('qur_id');
            $table->string('que_text', 100);
            $table->string('que_type', 50);
            $table->boolean('que_required');
            $table->integer('que_points');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ftw_ms_questions');
    }
};
