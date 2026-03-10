@echo off
echo ========================================
echo Menjalankan Seeder Transaksi
echo ========================================
echo.

echo [1/2] Menjalankan OrderSeeder...
php artisan db:seed --class=OrderSeeder
echo.

echo [2/2] Menjalankan TransaksiSeeder...
php artisan db:seed --class=TransaksiSeeder
echo.

echo ========================================
echo Seeder Selesai!
echo ========================================
echo.
echo Cek hasil di admin panel:
echo http://localhost:8000/admin/transaksis
echo.
pause
