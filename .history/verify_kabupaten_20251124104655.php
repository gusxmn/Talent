<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make('Illuminate\Contracts\Http\Kernel');
$kernel->handle($request = \Illuminate\Http\Request::capture());

echo "Verifying Kabupaten Data Update\n";
echo "================================\n\n";

// Check Aceh data
$acehs = \App\Models\Regency::where('province_id', '11')->orderBy('id')->limit(5)->with('province')->get();

echo "Sample Aceh Kabupaten:\n";
foreach ($acehs as $r) {
    echo $r->id . " - " . $r->name . " (" . $r->province->name . ")\n";
}

// Check Sumatera Utara data
echo "\n\nSample Sumatera Utara Kabupaten:\n";
$sumas = \App\Models\Regency::where('province_id', '12')->orderBy('id')->limit(5)->with('province')->get();
foreach ($sumas as $r) {
    echo $r->id . " - " . $r->name . " (" . $r->province->name . ")\n";
}

// Total count
echo "\n\nTotal Kabupaten: " . \App\Models\Regency::count();

echo "\n\nUpdate complete!\n";
?>
