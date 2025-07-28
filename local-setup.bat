@echo off
echo ========================================
echo    Kashish World - Local Setup (No Docker)
echo ========================================
echo.

echo This will set up the project without Docker.
echo You'll need:
echo - XAMPP or WAMP (for PHP and MySQL)
echo - Composer
echo - Node.js
echo.

echo Step 1: Check if XAMPP is installed...
if exist "C:\xampp\xampp-control.exe" (
    echo ✓ XAMPP found at C:\xampp
    set XAMPP_PATH=C:\xampp
) else if exist "C:\Program Files\xampp\xampp-control.exe" (
    echo ✓ XAMPP found at C:\Program Files\xampp
    set XAMPP_PATH=C:\Program Files\xampp
) else (
    echo ✗ XAMPP not found
    echo Please install XAMPP from: https://www.apachefriends.org/
    echo Then run this script again
    pause
    exit /b 1
)

echo.
echo Step 2: Check PHP...
php --version >nul 2>&1
if %errorlevel% equ 0 (
    echo ✓ PHP is available
    php --version
) else (
    echo ✗ PHP not found in PATH
    echo Adding XAMPP PHP to PATH for this session...
    set PATH=%XAMPP_PATH%\php;%PATH%
    php --version >nul 2>&1
    if %errorlevel% equ 0 (
        echo ✓ PHP now available
    ) else (
        echo ✗ Still can't find PHP
        echo Please ensure XAMPP is properly installed
        pause
        exit /b 1
    )
)

echo.
echo Step 3: Check Composer...
composer --version >nul 2>&1
if %errorlevel% equ 0 (
    echo ✓ Composer is available
) else (
    echo ✗ Composer not found
    echo Installing Composer...
    echo Please install Composer from: https://getcomposer.org/download/
    pause
    exit /b 1
)

echo.
echo Step 4: Check Node.js...
node --version >nul 2>&1
if %errorlevel% equ 0 (
    echo ✓ Node.js is available
    node --version
) else (
    echo ✗ Node.js not found
    echo Please install Node.js from: https://nodejs.org/
    pause
    exit /b 1
)

echo.
echo Step 5: Install dependencies...
echo Installing PHP dependencies...
composer install

echo Installing Node.js dependencies...
npm install

echo.
echo Step 6: Setup environment...
if not exist ".env" (
    echo Copying .env.example to .env...
    copy .env.example .env
)

echo Generating application key...
php artisan key:generate

echo.
echo Step 7: Database setup...
echo.
echo IMPORTANT: Please ensure MySQL is running in XAMPP
echo 1. Open XAMPP Control Panel
echo 2. Start Apache and MySQL services
echo 3. Create database 'ecommerce_laravel' in phpMyAdmin
echo.
echo Press any key when database is ready...
pause

echo Running migrations...
php artisan migrate --seed

echo Creating storage link...
php artisan storage:link

echo.
echo Step 8: Build assets...
npm run dev

echo.
echo ========================================
echo Setup Complete!
echo.
echo To start the application:
echo 1. Ensure XAMPP Apache and MySQL are running
echo 2. Run: php artisan serve
echo 3. Open: http://localhost:8000
echo.
echo Admin Login:
echo - Email: admin@example.com
echo - Password: password
echo ========================================
pause
