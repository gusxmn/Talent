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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            
            // Foreign Keys
            // Menghubungkan ke tabel lowongan (job_listings)
            $table->foreignId('job_listing_id')->constrained('job_listings')->onDelete('cascade');
            // Menghubungkan ke tabel pengguna (pelamar)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Data Lamaran
            $table->enum('status', [
                'pending', 
                'reviewed', 
                'interview', 
                'rejected', 
                'hired'
            ])->default('pending')->index();
            
            $table->string('cv_path')->nullable()->comment('Path file CV/Resume');
            $table->text('cover_letter')->nullable()->comment('Isi surat lamaran atau path file');
            
            $table->timestamp('applied_at')->useCurrent()->comment('Waktu lamaran diajukan');
            
            $table->timestamps(); // created_at (saat migrasi), updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};