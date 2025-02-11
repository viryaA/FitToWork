<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ftw_ms_karyawans', function (Blueprint $table) {
            $table->char('kry_id', 10)->primary();
            $table->string('kry_nama_depan', 100);
            $table->string('kry_nama_blk', 100);
            $table->string('kry_tempat_lahir', 50);
            $table->datetime('kry_tgl_lahir');
            $table->char('kry_jenis_kelamin', 2);
            $table->string('kry_alamat', 255);
            $table->string('kry_email', 50);
            $table->string('Bagian', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ftw_ms_karyawans');
    }
};
