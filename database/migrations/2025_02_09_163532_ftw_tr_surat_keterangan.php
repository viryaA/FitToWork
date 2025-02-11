<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ftw_tr_surat_keterangan', function (Blueprint $table) {
            $table->id('skn_id');
            $table->string('usr_id', 50);
            $table->text('skn_berkas');
            $table->string('skn_status', 50)->default('Aktif'); 
            $table->string('skn_created_by', 50);
            $table->timestamp('skn_created_date')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ftw_tr_surat_keterangan');
    }
};
