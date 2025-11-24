@echo off
setlocal enabledelayedexpansion
cd /d "C:\Users\MyBook Hype AMD\Talent"

echo.
echo ============================================
echo Step 1: Creating missing kecamatan...
echo ============================================
php artisan db:seed --class=CreateMissingKecamatanSeeder
if !errorlevel! neq 0 (
    echo Error in CreateMissingKecamatanSeeder
    pause
    exit /b 1
)

echo.
echo ============================================
echo Step 2: Re-importing desa records...
echo ============================================
php artisan db:seed --class=UpdateDesaSeeder
if !errorlevel! neq 0 (
    echo Error in UpdateDesaSeeder
    pause
    exit /b 1
)

echo.
echo ============================================
echo Step 3: Verifying import...
echo ============================================
php artisan tinker --execute="echo 'Total Desa: ' . App\Models\Desa::count() . PHP_EOL; echo 'Total Kecamatan: ' . App\Models\Kecamatan::count() . PHP_EOL; echo 'Total Kabupaten: ' . App\Models\Kabupaten::count() . PHP_EOL;"

echo.
echo ============================================
echo Completed!
echo ============================================
pause
