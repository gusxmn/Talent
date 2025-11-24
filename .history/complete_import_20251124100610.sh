#!/bin/bash
# Run this script to complete the desa data import

cd "C:\Users\MyBook Hype AMD\Talent"

echo "Step 1: Creating missing kecamatan..."
php artisan db:seed --class=CreateMissingKecamatanSeeder

echo ""
echo "Step 2: Re-importing desa with complete kecamatan hierarchy..."
php artisan db:seed --class=UpdateDesaSeeder

echo ""
echo "Step 3: Verifying import..."
php artisan tinker << 'EOF'
echo "Total Desa: " . App\Models\Desa::count() . "\n";
echo "Total Kecamatan: " . App\Models\Kecamatan::count() . "\n";
echo "Total Kabupaten: " . App\Models\Kabupaten::count() . "\n";
EOF

echo ""
echo "Done!"
