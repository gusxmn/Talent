<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'slug',
        'logo',
        'industri',
        'website',
        'email',
        'telepon',
        'alamat',
        'deskripsi',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Auto-slug saat membuat
    protected static function booted()
    {
        static::creating(function ($company) {
            $company->slug = Str::slug($company->nama);
        });
    }

    // Scope aktif
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    // Relasi ke JobListing
    public function jobListings()
    {
        return $this->hasMany(JobListing::class);
    }
}