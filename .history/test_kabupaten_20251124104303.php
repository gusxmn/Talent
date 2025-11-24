<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make('Illuminate\Contracts\Http\Kernel');
$kernel->handle($request = \Illuminate\Http\Request::capture());

echo "Testing Kabupaten Data Structure\n";
echo "================================\n\n";

$regencies = \App\Models\Regency::with('province')->limit(5)->get();

echo "Total Kabupaten: " . \App\Models\Regency::count() . "\n\n";

echo "Sample Data:\n";
foreach ($regencies as $regency) {
    echo "- {$regency->name} (ID: {$regency->id}) - Provinsi: {$regency->province->name}\n";
}

echo "\n\nAPI Response Structure (getKabupaten):\n";
$controller = new \App\Http\Controllers\Admin\KabupatenController();
$apiResponse = $controller->getKabupaten();
$data = $apiResponse->getData();
echo "Success: " . ($data->success ? 'YES' : 'NO') . "\n";
echo "Total in API: " . count($data->data) . "\n";
if (count($data->data) > 0) {
    echo "Sample API response: " . json_encode($data->data[0]) . "\n";
}

echo "\n\nDone!\n";
?>
