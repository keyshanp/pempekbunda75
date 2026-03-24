@echo off
echo ========================================
echo   Starting Pempek Bunda 75 Server
echo ========================================
echo.

cd /d "%~dp0"

echo Checking PHP...
"C:\laragon\bin\php\php-8.3.13-nts-Win32-vs16-x64\php.exe" -v
echo.

echo Starting Laravel server...
echo Server will run at: http://127.0.0.1:8000
echo.
echo Press Ctrl+C to stop the server
echo ========================================
echo.

"C:\laragon\bin\php\php-8.3.13-nts-Win32-vs16-x64\php.exe" artisan serve

pause
