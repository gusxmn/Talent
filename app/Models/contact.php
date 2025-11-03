<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    
    /**
     * Nama tabel di database.
     * Secara default Laravel akan mencari 'contacts' (plural),
     * jadi ini bersifat opsional tetapi disarankan untuk eksplisit.
     * @var string
     */
    protected $table = 'contacts';
    
    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     * Kolom-kolom ini harus sesuai persis dengan yang ada di migrasi Anda.
     * @var array
     */
    protected $fillable = [
        'nama',
        'email',
        'subjek',
        'pesan',
        'sudah_dibaca', // Kolom status boolean
    ];

    /**
     * Atribut yang harus di-cast ke tipe data asli.
     * 'sudah_dibaca' harus berupa boolean.
     * @var array
     */
    protected $casts = [
        'sudah_dibaca' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | SCOPES (Opsional: Memudahkan Query)
    |--------------------------------------------------------------------------
    */

    /**
     * Scope untuk mengambil pesan yang belum dibaca (Unread).
     * Penggunaan: Contact::unread()->get()
     */
    public function scopeUnread($query)
    {
        return $query->where('sudah_dibaca', false);
    }
    
    /**
     * Scope untuk mengambil pesan yang sudah dibaca (Read).
     * Penggunaan: Contact::read()->get()
     */
    public function scopeRead($query)
    {
        return $query->where('sudah_dibaca', true);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR (Opsional: Format Data Saat Diambil)
    |--------------------------------------------------------------------------
    */
    
    /**
     * Accessor untuk mendapatkan status baca dalam bentuk teks.
     */
    public function getStatusTextAttribute()
    {
        return $this->sudah_dibaca ? 'Sudah Dibaca' : 'Belum Dibaca';
    }
}