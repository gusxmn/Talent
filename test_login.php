<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

// Test 1: Cek user ada
$user = User::where('email', 'superadmin@gmail.com')->first();
echo "User ditemukan: " . ($user ? 'Ya' : 'Tidak') . "\n";

if ($user) {
    echo "User ID: " . $user->id . "\n";
    echo "User Role: " . $user->role . "\n";
    echo "User Email: " . $user->email . "\n";
    
    // Test 2: Cek password
    $passwordCorrect = Hash::check('superadmin2025', $user->password);
    echo "Password benar: " . ($passwordCorrect ? 'Ya' : 'Tidak') . "\n";
    
    // Test 3: Cek middleware check
    $isAdmin = in_array($user->role, ['super admin', 'admin', 'pimpinan', 'testdev']);
    echo "Dapat akses admin: " . ($isAdmin ? 'Ya' : 'Tidak') . "\n";
    
    // Test 4: Manual login
    Auth::login($user);
    echo "Login berhasil: " . (Auth::check() ? 'Ya' : 'Tidak') . "\n";
    echo "Logged user: " . Auth::user()->email . "\n";
}
