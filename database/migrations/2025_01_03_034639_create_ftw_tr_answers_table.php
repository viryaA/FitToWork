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
        Schema::create('ftw_tr_answers', function (Blue
        print $table) {
            $table->id('ans_id');
            $table->foreignId('res_id');
            $table->foreignId('que_id');
            $table->foreignId('que_id')->nullable();
            $table->string('ans_text', 100)->nullable();
            $table->integer('ans_points_earned')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ftw_tr_answers');
    }
};
