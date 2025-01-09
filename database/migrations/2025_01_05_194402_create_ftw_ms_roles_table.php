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
        Schema::create('ftw_ms_role', function (Blueprint $table) {
            $table->char('rol_id', 5)->primary(); // PK
            $table->string('rol_deskripsi', 50)->nullable();
            $table->string('rol_status', 15)->nullable();
            $table->string('rol_created_by', 50)->nullable();
            $table->dateTime('rol_created_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ftw_ms_roles');
    }
};
