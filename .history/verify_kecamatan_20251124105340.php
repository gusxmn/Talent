<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make('Illuminate\Contracts\Http\Kernel');
$kernel->handle($request = \Illuminate\Http\Request::capture());

echo "Verifying Kecamatan Data with Relationships\n";
echo "==============================================\n\n";

$kecamatans = \App\Models\Kecamatan::with(['kabupaten', 'kabupaten.provinsi'])->limit(5)->get();

foreach ($kecamatans as $k) {
    echo "Kecamatan: {$k->nama_kecamatan}\n";
    echo "  Kabupaten: {$k->kabupaten->nama_kabupaten}\n";
    echo "  Provinsi: {$k->kabupaten->provinsi->nama_provinsi}\n";
    echo "  ---\n";
}

echo "\nDone!\n";
?>
