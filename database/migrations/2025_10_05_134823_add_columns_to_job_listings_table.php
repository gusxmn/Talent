<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->text('requirements')->nullable()->after('description'); // Persyaratan
            $table->text('skills')->nullable()->after('requirements'); // Skill
            $table->text('qualifications')->nullable()->after('skills'); // Kualifikasi

            $table->enum('job_type', [
                'penuh_waktu',
                'kontrak',
                'magang',
                'paruh_waktu',
                'freelance',
                'harian'
            ])->default('penuh_waktu')->after('salary_max');

            $table->enum('work_policy', [
                'kerja_di_kantor',
                'hybrid',
                'remote'
            ])->default('kerja_di_kantor')->after('job_type');

            $table->enum('experience_level', [
                'tidak_berpengalaman',
                'fresh_graduate',
                'kurang_dari_setahun',
                '1_3_tahun',
                '3_5_tahun',
                '5_10_tahun',
                'lebih_dari_10_tahun'
            ])->default('fresh_graduate')->after('work_policy');

            $table->enum('education_level', [
                's3',
                's2',
                's1',
                'd1_d4',
                'sma_smk',
                'smp',
                'sd'
            ])->default('sma_smk')->after('experience_level');
        });
    }

    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->dropColumn([
                'requirements',
                'skills',
                'qualifications',
                'job_type',
                'work_policy',
                'experience_level',
                'education_level'
            ]);
        });
    }
};
