<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'lokasi',
        'whatsapp', 
        'google_id', 
        'avatar',
        'gender',
        'upload_cv',
        'upload_ijazah',
        'link_github',
        'link_portofolio',
        'skills',
        'tentang_anda',
        'asal_sekolah',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // HAPUS: 'password' => 'hashed', 
        // ALASAN: Kolom password tidak perlu di-hash otomatis 
        // karena kita mengizinkan NULL untuk Google Login.
    ];

    /**
     * Scope untuk user aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true); // Perbaikan: Ganti 'status' menjadi 'is_active'
    }

    /**
     * Scope untuk user berdasarkan role
     */
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }
    
   
    
}
