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
        Schema::create('ftw_ms_mahasiswas', function (Blueprint $table) {
            $table->char('mhs_id', 10)->primary();
            $table->string('mhs_nama', 255);
            $table->string('mhs_tempat_lahir', 255);
            $table->datetime('mhs_tgl_lahir');
            $table->string('mhs_alamat', 255);
            $table->string('mhs_hp', 50);
            $table->char('mhs_jenis_kelamin', 2);
            $table->string('mhs_email', 50);
            $table->char('mhs_angkatan', 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ftw_ms_mahasiswas');
    }
};
