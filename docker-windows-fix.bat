@echo off
echo ========================================
echo    Docker Setup - Alternative Method
echo ========================================
echo.

echo Trying to switch Docker to Windows containers...
echo.

echo Method 1: Using Docker Desktop GUI
echo 1. Right-click Docker whale icon in system tray
echo 2. Click "Switch to Windows containers..."
echo 3. Wait for the switch to complete
echo 4. Try running: docker-compose up --build
echo.

echo Method 2: Command line switch
"C:\Program Files\Docker\Docker\DockerCli.exe" -SwitchWindowsEngine
if %errorlevel% equ 0 (
    echo ✓ Switched to Windows containers
) else (
    echo Could not switch automatically
)

echo.
echo Method 3: Reset Docker Desktop
echo 1. Open Docker Desktop
echo 2. Go to Settings (gear icon)  
echo 3. Click "Reset to factory defaults"
echo 4. Wait for reset to complete
echo 5. Try the setup again
echo.

echo ========================================
echo After trying any method above, run:
echo docker-compose up --build
echo ========================================
pause
