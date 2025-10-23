<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    
    // Tentukan nama tabel
    protected $table = 't_profile'; 
    protected $guarded = []; // Atur sesuai kebutuhan
}