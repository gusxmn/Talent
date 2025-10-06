<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     * @var string
     */
    protected $table = 'schedules';

    /**
     * Atribut yang bisa diisi.
     * @var array<int, string>
     */
    protected $fillable = [
        'application_id',
        'type',
        'start_time',
        'end_time',
        'location',
        'notes',
        'created_by', // ID admin/HRD yang menjadwalkan
    ];

    /**
     * Atribut yang harus diubah ke tipe data tertentu saat diambil.
     * @var array<string, string>
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // ===============================================
    // RELATIONS
    // ===============================================

    /**
     * Relasi Many-to-One: Jadwal ini dimiliki oleh satu Lamaran.
     */
    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }

    /**
     * Relasi Many-to-One: Jadwal ini dibuat/dijadwalkan oleh satu User (Admin/HRD).
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}