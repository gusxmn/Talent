<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    use HasFactory;

    protected $table = 'magang';

    protected $fillable = [
        'judul',
        'perusahaan',
        'logo_perusahaan',
        'deskripsi',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',
        'durasi',
        'posisi',
        'kuota',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'status' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | 🔗 Relasi ke tabel wilayah (dari API wilayah Indonesia)
    |--------------------------------------------------------------------------
    */
    public function province()
    {
        return $this->belongsTo(Province::class, 'provinsi_id', 'id');
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'kabupaten_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'kecamatan_id', 'id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'desa_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | 🗺️ Accessor: Mendapatkan lokasi lengkap (ex: "Desa X, Kecamatan Y, Kabupaten Z, Provinsi W")
    |--------------------------------------------------------------------------
    */
    public function getFullLocationAttribute()
    {
        $parts = [];

        if ($this->village) {
            $parts[] = $this->village->name;
        }
        if ($this->district) {
            $parts[] = $this->district->name;
        }
        if ($this->regency) {
            $parts[] = $this->regency->name;
        }
        if ($this->province) {
            $parts[] = $this->province->name;
        }

        return implode(', ', $parts);
    }

    /*
    |--------------------------------------------------------------------------
    | 🔍 Scope: Hanya lowongan magang aktif
    |--------------------------------------------------------------------------
    */
    public function scopeAktif($query)
    {
        return $query->where('status', true)
                     ->where(function ($q) {
                         $q->whereNull('tanggal_selesai')
                           ->orWhere('tanggal_selesai', '>=', now());
                     });
    }

    /*
    |--------------------------------------------------------------------------
    | 🔍 Scope: Pencarian berdasarkan judul, perusahaan, atau posisi
    |--------------------------------------------------------------------------
    */
    public function scopeCari($query, $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('judul', 'like', "%{$keyword}%")
              ->orWhere('perusahaan', 'like', "%{$keyword}%")
              ->orWhere('posisi', 'like', "%{$keyword}%");
        });
    }
}
