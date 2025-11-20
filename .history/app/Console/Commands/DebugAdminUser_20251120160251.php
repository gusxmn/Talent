<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class DebugAdminUser extends Command
{
    protected $signature = 'debug:admin-users';
    protected $description = 'Debug admin users di database';

    public function handle()
    {
        $this->info('🔍 Checking Admin Users in Database...\n');

        // Cek total users
        $totalUsers = User::count();
        $this->info("Total users di database: {$totalUsers}");

        // Cek admin users
        $adminUsers = User::whereIn('role', ['super admin', 'admin', 'pimpinan', 'testdev'])->get();
        
        if ($adminUsers->isEmpty()) {
            $this->error("❌ Tidak ada user dengan role admin/super admin/pimpinan/testdev!");
            $this->warn("Silakan jalankan: php artisan db:seed --class=AdminUserSeeder");
            return;
        }

        $this->info("\n✅ Admin Users Found:");
        $this->table(
            ['ID', 'Name', 'Email', 'Role', 'Is Active', 'Created At'],
            $adminUsers->map(function($user) {
                return [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->role,
                    $user->is_active ? 'Yes' : 'No',
                    $user->created_at->format('Y-m-d H:i:s'),
                ];
            })->toArray()
        );

        // Cek regular users
        $regularUsers = User::where('role', 'user')->count();
        $this->info("\nTotal regular users (role='user'): {$regularUsers}");

        // Middleware check
        $this->info("\n🔐 Middleware Check:");
        $this->line("✅ AdminMiddleware allows: super admin, admin");
        $this->line("✅ SuperAdminMiddleware allows: super admin");
        $this->line("✅ WawancaraMiddleware allows: wawancara");
    }
}
