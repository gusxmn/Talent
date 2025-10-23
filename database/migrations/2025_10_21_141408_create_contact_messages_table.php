<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            // Kolom Status (0=Belum Dibaca, 1=Sudah Dibaca)
            // Default 0 karena saat masuk, pesan belum dibaca
            $table->tinyInteger('status')->default(0); 
            // Kolom Active (1=Aktif/Ada, 0=Tidak Aktif/Dihapus)
            // Default 1 karena saat masuk, pesan aktif
            $table->tinyInteger('active')->default(1);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            // Kolom untuk Soft Deletes
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_messages');
    }
};