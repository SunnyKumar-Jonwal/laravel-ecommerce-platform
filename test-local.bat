@echo off
echo ========================================
echo    Kashish World - Local Test
echo ========================================
echo.

echo Checking system requirements...

:: Check PHP
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ✗ PHP is not installed or not in PATH
    echo Please install PHP 8.1 or higher
    echo Download from: https://www.php.net/downloads
    pause
    exit /b 1
) else (
    echo ✓ PHP found
)

:: Check Composer
composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ✗ Composer is not installed
    echo Download from: https://getcomposer.org/download/
    pause
    exit /b 1
) else (
    echo ✓ Composer found
)

:: Check Node.js
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ✗ Node.js is not installed
    echo Download from: https://nodejs.org/
    pause
    exit /b 1
) else (
    echo ✓ Node.js found
)

echo.
echo Installing dependencies...

:: Install PHP dependencies
echo Installing PHP dependencies...
composer install

:: Install Node dependencies
echo Installing Node.js dependencies...
npm install

:: Check if .env exists
if not exist ".env" (
    echo Creating .env file...
    copy .env.example .env
    php artisan key:generate
)

echo.
echo Building assets...
npm run dev

echo.
echo ========================================
echo Setup Complete!
echo.
echo To start the server:
echo   php artisan serve
echo.
echo Then visit: http://localhost:8000
echo Admin panel: http://localhost:8000/admin
echo ========================================
pause
