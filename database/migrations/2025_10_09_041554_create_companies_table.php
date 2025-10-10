<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            // Identitas perusahaan
            $table->string('nama'); // Nama perusahaan
            $table->string('slug')->unique(); // URL-friendly identifier
            $table->string('logo')->nullable(); // Path logo perusahaan
            $table->string('industri')->nullable(); // Industri (misal: Teknologi, Finansial)
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();

            // Lokasi dan deskripsi
            $table->text('alamat')->nullable();
            $table->text('deskripsi')->nullable();

            // Status aktif/nonaktif
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};