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
        Schema::create('application_history', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key: Menghubungkan ke tabel lamaran (applications)
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            
            // Data Riwayat
            $table->string('old_status')->nullable()->comment('Status lamaran sebelumnya');
            $table->string('new_status')->comment('Status lamaran yang baru');
            
            // Siapa yang melakukan perubahan (biasanya admin/HRD)
            $table->foreignId('changed_by_user_id')->nullable()->constrained('users')->onDelete('set null')->comment('Admin yang melakukan perubahan');
            
            $table->text('reason')->nullable()->comment('Alasan singkat atau catatan mengenai perubahan status');

            $table->timestamps(); // created_at akan mencatat kapan perubahan terjadi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_history');
    }
};