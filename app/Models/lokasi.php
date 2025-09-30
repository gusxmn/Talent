<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasi'; // Nama tabel di database

    protected $fillable = [
        'negara',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'desa',
        'kode_pos',
    ];

    // Optional: casting untuk konsistensi data
    protected $casts = [
        'kode_pos' => 'string',
    ];

    // Optional: default value untuk negara
    protected $attributes = [
        'negara' => 'Indonesia',
    ];

    // Optional: scope untuk filter wilayah
    public function scopeWilayah($query, $provinsi = null, $kabupaten = null)
    {
        return $query
            ->when($provinsi, fn($q) => $q->where('provinsi', $provinsi))
            ->when($kabupaten, fn($q) => $q->where('kabupaten', $kabupaten));
    }
}