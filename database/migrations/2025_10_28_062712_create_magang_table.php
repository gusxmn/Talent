<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel magang.
     */
    public function up(): void
    {
        Schema::create('magang', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Judul lowongan magang
            $table->string('perusahaan'); // Nama perusahaan
            $table->string('logo_perusahaan')->nullable(); // Logo perusahaan (opsional)
            $table->text('deskripsi'); // Deskripsi pekerjaan
            $table->string('lokasi'); // Lokasi magang
            $table->string('durasi'); // Misal: 3 bulan, 6 bulan, dsb.
            $table->string('posisi'); // Posisi/jabatan magang
            $table->integer('kuota')->default(1); // Jumlah peserta magang yang dibutuhkan
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->boolean('status')->default(true); // true = aktif, false = nonaktif
            $table->timestamps();
        });
    }

    /**
     * Undo migrasi (hapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('magang');
    }
};
