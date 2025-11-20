<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('campuses', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('no_hp');
            $table->enum('jabatan', ['rektor', 'wakil rektor', 'dekan', 'kajur', 'dosen', 'staff', 'lainnya']);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nama_kampus');
            $table->enum('jumlah_pegawai', ['1-100', '101-500', '501-1000', '1001-5000', '5001-10000', '10000+']);
            $table->enum('jenis_institusi', ['Universitas', 'Institut', 'Sekolah Tinggi', 'Politeknik', 'SMA/SMK', 'SMP', 'SD', 'Lainnya']);
            $table->string('logo_path')->nullable();
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan')->nullable(); // Kolom baru
            $table->string('desa_kelurahan')->nullable(); // Kolom baru
            $table->text('alamat_lengkap');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('campuses');
    }
};