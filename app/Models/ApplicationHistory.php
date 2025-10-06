<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationHistory extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     * @var string
     */
    protected $table = 'application_history';

    /**
     * Atribut yang bisa diisi (mass assignable).
     * @var array<int, string>
     */
    protected $fillable = [
        'application_id',
        'old_status',
        'new_status',
        'changed_by_user_id',
        'reason',
    ];

    /**
     * Atribut yang harus diubah ke tipe data tertentu saat diambil.
     * Tidak ada casting spesifik yang diperlukan selain timestamps bawaan.
     * @var array<string, string>
     */
    protected $casts = [
        // 'created_at' => 'datetime', // Dibuat otomatis oleh timestamps()
    ];

    // ===============================================
    // RELATIONS
    // ===============================================

    /**
     * Relasi Many-to-One: Riwayat ini dimiliki oleh satu Lamaran.
     */
    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }

    /**
     * Relasi Many-to-One: Perubahan dilakukan oleh satu User (Admin/HRD).
     */
    public function changer()
    {
        // Model User yang melakukan perubahan status
        return $this->belongsTo(User::class, 'changed_by_user_id');
    }
}