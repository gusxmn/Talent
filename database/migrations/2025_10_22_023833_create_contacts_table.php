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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();

            // Kolom dari formulir kontak Anda
            $table->string('nama'); // Nama Anda
            $table->string('email'); // Alamat Email Anda
            $table->string('subjek')->nullable(); // Subjek, dibuat nullable karena seringkali opsional
            $table->text('pesan'); // Pesan Anda, menggunakan tipe TEXT untuk pesan panjang

            // Kolom tambahan untuk manajemen pesan di backend
            $table->boolean('sudah_dibaca')->default(false); // Status pesan (sudah/belum dibaca)

            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};