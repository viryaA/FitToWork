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
        Schema::create('ftw_ms_questionnaires', function (Blueprint $table) {
            $table->id('qur_id');
            $table->string('qur_title', 255);
            $table->text('qur_description')->nullable();
            $table->timestamp('qur_creation_date')->useCurrent();
            $table->string('qur_created_by', 255)->nullable();
            $table->timestamp('qur_last_update_date')->useCurrent();
            $table->string('qur_last_updated_by', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ftw_ms_questionnaires');
    }
};
