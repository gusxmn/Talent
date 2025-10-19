<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Digunakan untuk PostgreSQL

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            // Mengubah kolom 'password' menjadi nullable
            // Perlu menggunakan change() dan menginstal doctrine/dbal jika belum (lihat catatan di bawah)
            $table->string('password')->nullable()->change(); 
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            // Mengembalikan kolom 'password' menjadi not-nullable (default Laravel)
            $table->string('password')->nullable(false)->change();
        });
    }
};
