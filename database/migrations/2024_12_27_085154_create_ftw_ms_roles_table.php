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
        Schema::create('ftw_ms_roles', function (Blueprint $table) {
            $table->char('rol_id', 5)->primary();
            $table->string('rol_deskripsi', 50);
            $table->string('rol_status', 15);
            $table->string('rol_created_by', 50);
            $table->datetime('rol_created_date');
            $table->timestamps();
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
