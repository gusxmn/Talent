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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key: Menghubungkan ke tabel lamaran (applications)
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            
            // Data Jadwal
            $table->enum('type', [
                'interview_hr', 
                'technical_test', 
                'final_interview', 
                'onboarding'
            ])->comment('Jenis kegiatan/tahapan');

            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            
            $table->string('location')->nullable()->comment('Lokasi fisik atau link meeting');
            $table->text('notes')->nullable()->comment('Instruksi atau catatan untuk pelamar');
            
            // Opsional: Siapa yang membuat/mengelola jadwal (misal: admin/HRD)
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null')->comment('Admin/HRD yang menjadwalkan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};