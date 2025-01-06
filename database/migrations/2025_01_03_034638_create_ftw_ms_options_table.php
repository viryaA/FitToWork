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
        Schema::create('ftw_ms_options', function (Blueprint $table) {
            $table->id('opt_id');
            $table->foreignId('que_id');
            $table->string('opt_text', 100);
            $table->boolean('opt_is_correct');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ftw_ms_options');
    }
};
