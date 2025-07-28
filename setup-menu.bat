@echo off
title Kashish World - Setup Menu
echo ========================================
echo    Kashish World E-Commerce Platform
echo ========================================
echo.

:menu
echo Main Menu - Database: ecommerce_laravel
echo.
echo 1. Docker Setup (Try this first)
echo 2. Fix Docker Issues
echo 3. Local Setup (XAMPP/WAMP)
echo 4. Check system requirements  
echo 5. Verify Docker installation
echo 6. View application (if running)
echo 7. Exit
echo.
set /p choice="Please select an option (1-7): "

if "%choice%"=="1" goto docker_setup
if "%choice%"=="2" goto fix_docker
if "%choice%"=="3" goto local_setup
if "%choice%"=="4" goto system_check
if "%choice%"=="5" goto verify_docker
if "%choice%"=="6" goto view_app
if "%choice%"=="7" goto exit

echo Invalid choice. Please try again.
echo.
goto menu

:docker_setup
cls
echo ========================================
echo    Docker Setup
echo ========================================
echo.
echo Building and starting Docker containers...
echo This may take 5-10 minutes on first run.
echo.
docker-compose up --build
if %errorlevel% equ 0 (
    echo.
    echo ✓ Docker setup complete!
    echo.
    echo Access your application:
    echo - Frontend: http://localhost:8000
    echo - Admin: http://localhost:8000/admin
    echo.
    echo Default admin login:
    echo - Email: admin@example.com
    echo - Password: password
) else (
    echo.
    echo ✗ Docker setup failed!
    echo Try option 2 to fix Docker issues.
)
echo.
pause
goto menu

:fix_docker
cls
echo ========================================
echo    Fix Docker Issues
echo ========================================
echo.
echo Common fixes:
echo 1. Restart your computer
echo 2. Open Docker Desktop and wait for it to start
echo 3. Try switching Docker to Windows containers
echo 4. Reset Docker to factory defaults
echo.
echo Running automated fix...
call fix-docker.bat
pause
goto menu

:local_setup
cls
echo ========================================
echo    Local Setup (No Docker)
echo ========================================
echo.
call local-setup.bat
pause
goto menu
goto menu

:setup_app
echo.
echo Setting up application...
call docker-setup.bat
goto menu

:troubleshoot
echo.
echo Starting troubleshooting tool...
call troubleshoot.bat
goto menu

:complete_setup
echo.
echo Running complete automated setup...
call complete-setup.bat
goto menu

:view_app
echo.
echo Opening application in browser...
start http://localhost:8000
echo Application opened in browser
echo.
pause
goto menu

:exit
echo.
echo Thank you for using Kashish World!
echo.
pause
exit /b 0
