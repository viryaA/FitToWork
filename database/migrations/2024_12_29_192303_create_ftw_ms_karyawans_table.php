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
        Schema::create('ftw_ms_karyawans', function (Blueprint $table) {
            $table->char('kry_id', 10)->primary();
            $table->string('kry_nama_depan', 100);
            $table->string('kry_nama_blkng', 100);
            $table->string('kry_username', 50);
            $table->string('kry_tempat_lahir', 50);
            $table->datetime('kry_tgl_lahir');
            $table->char('kry_jenis_kelamin', 2);
            $table->char('kry_no_hp', 15);
            $table->text('kry_alamat');
            $table->string('kry_email', 50);
            $table->timestamps(); // Kolom created_at dan updated_at
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ftw_ms_karyawans');
    }
};
