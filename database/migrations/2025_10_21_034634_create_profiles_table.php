<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Nama tabel sesuai permintaan: t_profile
        Schema::create('t_profile', function (Blueprint $table) {
            $table->id();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('operation_hours')->nullable();
            // Presisi Tinggi untuk Latitude (15 desimal)
            $table->decimal('latitude', 17, 15)->nullable(); 
            // Presisi Tinggi untuk Longitude (14 desimal)
            $table->decimal('longitude', 18, 14)->nullable(); 
            $table->string('map_popup_text')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_profile');
    }
};