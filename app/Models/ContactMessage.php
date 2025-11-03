<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import Trait

class ContactMessage extends Model
{
    use SoftDeletes; // Gunakan Trait SoftDeletes

    protected $table = 'contact_messages';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'subject',
        'message',
        'status', // Tambahkan status
        'active', // Tambahkan active
        'read_at',
    ];

    protected $dates = [
        'read_at',
        'deleted_at', // Tambahkan deleted_at untuk SoftDeletes
    ];

    // ✅ tambahan cast supaya created_at dan updated_at jadi Carbon instance
    protected $casts = [
        'status' => 'boolean', // Cast status ke boolean (0/1)
        'active' => 'boolean', // Cast active ke boolean (0/1)
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope untuk mengambil pesan yang aktif (belum di-soft delete dan active=1).
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}