<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     * @var string
     */
    protected $table = 'applications';

    /**
     * Atribut yang bisa diisi (mass assignable).
     * @var array<int, string>
     */
    protected $fillable = [
        'job_listing_id',
        'user_id',
        'status',
        'cv_path',
        'cover_letter',
        'applied_at',
    ];

    /**
     * Atribut yang harus diubah ke tipe data tertentu saat diambil.
     * @var array<string, string>
     */
    protected $casts = [
        'applied_at' => 'datetime',
    ];

    // ===============================================
    // RELATIONS
    // ===============================================

    /**
     * Relasi Many-to-One: Lamaran ini dimiliki oleh satu Lowongan.
     */
    public function jobListing()
    {
        return $this->belongsTo(JobListing::class, 'job_listing_id');
    }

    /**
     * Relasi Many-to-One: Lamaran ini dibuat oleh satu User (Pelamar).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi One-to-Many: Lamaran ini memiliki banyak Jadwal (interview, tes).
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'application_id');
    }

    /**
     * Relasi One-to-Many: Lamaran ini memiliki banyak Riwayat Status.
     * (Asumsi Anda membuat model ApplicationHistory)
     */
    public function history()
    {
        // Ganti ApplicationHistory::class dengan model yang sesuai jika namanya berbeda
        return $this->hasMany(ApplicationHistory::class, 'application_id');
    }
}