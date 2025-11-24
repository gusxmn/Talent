@echo off
cd /d "C:\Users\MyBook Hype AMD\Talent"
php artisan db:seed --class=CreateMissingKecamatanSeeder
php artisan db:seed --class=UpdateDesaSeeder
pause
