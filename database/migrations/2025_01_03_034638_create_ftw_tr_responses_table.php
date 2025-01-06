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
        Schema::create('ftw_tr_responses', function (Blueprint $table) {
            $table->id('res_id');
            $table->foreignId('qur_id');
            $table->string('res_responder_id', 255);
            $table->char('res_type', 5);
            $table->timestamp('res_submitted_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ftw_tr_responses');
    }
};
