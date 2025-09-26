<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiTable extends Migration
{
    public function up()
    {
        Schema::create('lokasi', function (Blueprint $table) {
            $table->id();

            $table->string('negara', 100)->default('Indonesia');
            $table->string('provinsi', 100);
            $table->string('kabupaten', 100);
            $table->string('kecamatan', 100);
            $table->string('kelurahan', 100)->nullable();
            $table->string('desa', 100)->nullable();
            $table->string('kode_pos', 10)->nullable();

            $table->timestamps();

            // Optional indexing untuk query cepat
            $table->index(['provinsi', 'kabupaten', 'kecamatan']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('lokasi');
    }
}