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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Nama posisi
            $table->string('company'); // Nama perusahaan
            $table->string('company_logo')->nullable(); // Path logo perusahaan
            $table->string('location'); // Lokasi kerja
            $table->unsignedInteger('salary_min')->nullable(); // Gaji minimum
            $table->unsignedInteger('salary_max')->nullable(); // Gaji maksimum
            $table->enum('type', ['full-time', 'part-time', 'contract', 'internship'])->default('full-time'); // Jenis kerja
            $table->date('deadline')->nullable(); // Batas akhir lamaran
            $table->boolean('is_public')->default(true); // Status publikasi
            $table->text('description')->nullable(); // Deskripsi pekerjaan
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};