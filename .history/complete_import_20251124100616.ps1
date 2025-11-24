# PowerShell script to complete desa data import

cd "C:\Users\MyBook Hype AMD\Talent"

Write-Host "Step 1: Creating missing kecamatan..." -ForegroundColor Green
& php artisan db:seed --class=CreateMissingKecamatanSeeder

Write-Host ""
Write-Host "Step 2: Re-importing desa with complete kecamatan hierarchy..." -ForegroundColor Green
& php artisan db:seed --class=UpdateDesaSeeder

Write-Host ""
Write-Host "Step 3: Verifying import..." -ForegroundColor Green
& php artisan tinker --execute="
echo 'Total Desa: ' . App\Models\Desa::count() . PHP_EOL;
echo 'Total Kecamatan: ' . App\Models\Kecamatan::count() . PHP_EOL;
echo 'Total Kabupaten: ' . App\Models\Kabupaten::count() . PHP_EOL;
"

Write-Host ""
Write-Host "Done!" -ForegroundColor Cyan
