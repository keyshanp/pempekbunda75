@echo off
echo ========================================
echo Switching to SQLite Database
echo ========================================

REM Create SQLite database file
echo Creating SQLite database file...
type nul > database\database.sqlite

REM Backup current .env
echo Backing up .env...
copy .env .env.backup

REM Update .env to use SQLite
echo Updating .env configuration...
powershell -Command "(Get-Content .env) -replace 'DB_CONNECTION=mysql', 'DB_CONNECTION=sqlite' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_HOST=127.0.0.1', '# DB_HOST=127.0.0.1' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_PORT=3306', '# DB_PORT=3306' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_DATABASE=pempekbunda75', '# DB_DATABASE=pempekbunda75' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_USERNAME=root', '# DB_USERNAME=root' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_PASSWORD=', '# DB_PASSWORD=' | Set-Content .env"

REM Clear cache
echo Clearing cache...
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo.
echo ========================================
echo SQLite configuration complete!
echo ========================================
echo.
echo Next steps:
echo 1. Run: php artisan migrate:fresh --seed
echo 2. Run: php artisan serve
echo 3. Open: http://localhost:8000
echo.
pause
