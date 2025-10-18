<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $fillable = [
        'title',
        'company',
        'company_logo',
        'location',
        'salary_min',
        'salary_max',
        'type',
        'job_type',          // ✅ kolom baru
        'work_policy',       // ✅ kolom baru
        'experience_level',  // ✅ kolom baru
        'education_level',   // ✅ kolom baru
        'requirements',      // ✅ kolom baru
        'skills',            // ✅ kolom baru
        'qualifications',    // ✅ kolom baru
        'deadline',
        'is_public',
        'description',
    ];

    /**
     * Scope untuk ambil lowongan publik yang masih aktif.
     */
    public function scopePublic($query)
    {
        return $query->where('is_public', true)
                     ->whereDate('deadline', '>=', now());
    }

    /**
     * Format gaji untuk tampilan publik.
     */
    public function getFormattedSalaryAttribute(): string
    {
        if ($this->salary_min && $this->salary_max) {
            return 'Rp ' . number_format($this->salary_min, 0, ',', '.') . ' – Rp ' . number_format($this->salary_max, 0, ',', '.');
        }

        return 'Gaji tidak disebutkan';
    }

    /**
     * Format waktu posting (misal: "6 hari yang lalu").
     */
    public function getPostedAgoAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Path logo perusahaan untuk ditampilkan di Blade.
     */
    public function getLogoUrlAttribute(): string
    {
        return $this->company_logo
            ? asset('storage/' . $this->company_logo)
            : asset('images/default-company.png'); // fallback jika tidak ada logo
    }
}
