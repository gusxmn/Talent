<?php
// Direct database script to fix missing kecamatan
define('LARAVEL_START', microtime(true));
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Creating Missing Kecamatan ===\n";

// Get existing kecamatan
$existingKecamatan = DB::table('kecamatans')->pluck('id')->toArray();
$existingKecamatanSet = array_flip($existingKecamatan);

// Scan CSV for missing kecamatan
$missingKecamatan = [];
$csvFile = __DIR__ . '/database/data/desa.csv';
$file = fopen($csvFile, 'r');
$lineCount = 0;

while (($row = fgetcsv($file)) !== false) {
    if (empty($row) || count($row) < 2) {
        continue;
    }
    
    $kecamatan_id = intval($row[1]);
    if (!isset($existingKecamatanSet[$kecamatan_id]) && !isset($missingKecamatan[$kecamatan_id])) {
        $missingKecamatan[$kecamatan_id] = true;
    }
    
    $lineCount++;
    if ($lineCount % 10000 == 0) {
        echo "Scanned $lineCount lines...\n";
    }
}
fclose($file);

echo "Found " . count($missingKecamatan) . " missing kecamatan\n";

$created = 0;
$failed = 0;
$errors = [];

foreach (array_keys($missingKecamatan) as $kecamatan_id) {
    $kabupaten_id = intval(substr((string)$kecamatan_id, 0, 4));
    $kabupaten = DB::table('kabupatens')->where('id', $kabupaten_id)->first();
    
    if ($kabupaten) {
        try {
            // Check if already exists (race condition)
            if (!DB::table('kecamatans')->where('id', $kecamatan_id)->exists()) {
                DB::table('kecamatans')->insert([
                    'id' => $kecamatan_id,
                    'kabupaten_id' => $kabupaten_id,
                    'nama_kecamatan' => 'Kecamatan ' . $kecamatan_id,
                    'kode_kecamatan' => substr((string)$kecamatan_id, -2),
                    'status' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            $created++;
        } catch (Exception $e) {
            $failed++;
            if (count($errors) < 10) {
                $errors[] = "Kecamatan $kecamatan_id: " . $e->getMessage();
            }
        }
    } else {
        // Try to create kabupaten first
        $provinsi_id = intval(substr((string)$kabupaten_id, 0, 2));
        $provinsi = DB::table('provinsis')->where('id', $provinsi_id)->first();
        
        if ($provinsi) {
            try {
                // Create kabupaten
                if (!DB::table('kabupatens')->where('id', $kabupaten_id)->exists()) {
                    DB::table('kabupatens')->insert([
                        'id' => $kabupaten_id,
                        'provinsi_id' => $provinsi_id,
                        'nama_kabupaten' => 'Kabupaten ' . $kabupaten_id,
                        'kode_kabupaten' => substr((string)$kabupaten_id, -2),
                        'jenis' => 'Kabupaten',
                        'status' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                
                // Create kecamatan
                if (!DB::table('kecamatans')->where('id', $kecamatan_id)->exists()) {
                    DB::table('kecamatans')->insert([
                        'id' => $kecamatan_id,
                        'kabupaten_id' => $kabupaten_id,
                        'nama_kecamatan' => 'Kecamatan ' . $kecamatan_id,
                        'kode_kecamatan' => substr((string)$kecamatan_id, -2),
                        'status' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                $created++;
                echo "Created kabupaten $kabupaten_id and kecamatan $kecamatan_id\n";
            } catch (Exception $e) {
                $failed++;
                if (count($errors) < 10) {
                    $errors[] = "Kabupaten $kabupaten_id + Kecamatan $kecamatan_id: " . $e->getMessage();
                }
            }
        } else {
            $failed++;
            if (count($errors) < 10) {
                $errors[] = "Kecamatan $kecamatan_id: Provinsi $provinsi_id tidak ditemukan";
            }
        }
    }
}

echo "\nCreated $created missing kecamatan!\n";
if ($failed > 0) {
    echo "Failed to create $failed kecamatan\n";
}
if (!empty($errors)) {
    echo "\nSample errors:\n";
    foreach ($errors as $error) {
        echo "  $error\n";
    }
}

echo "\n=== Now importing remaining desas ===\n";
exec('cd "C:\Users\MyBook Hype AMD\Talent" && php artisan db:seed --class=UpdateDesaSeeder', $output, $returnCode);
echo implode("\n", $output) . "\n";

echo "\n=== Done ===\n";
