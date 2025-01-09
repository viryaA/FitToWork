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
        Schema::create('ftw_ms_users', function (Blueprint $table) {
            $table->string('usr_ID', 50)->primary(); // PK
            $table->char('rol_id', 5)->nullable();   // FK
            $table->string('usr_STATUS', 15)->nullable();
            $table->string('usr_created_by', 50)->nullable();
            $table->dateTime('usr_created_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ftw_ms_users');
    }
};
