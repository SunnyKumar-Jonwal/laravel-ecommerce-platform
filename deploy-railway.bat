@echo off
echo ========================================
echo    Kashish World - Railway Deployment
echo ========================================
echo.

echo Checking project files...

:: Check if git is initialized
if not exist ".git" (
    echo Initializing git repository...
    git init
    git add .
    git commit -m "Initial commit for Railway deployment"
)

:: Check for uncommitted changes
git diff --quiet
if %errorlevel% neq 0 (
    echo You have uncommitted changes. Committing them...
    git add .
    git commit -m "Ready for Railway deployment"
)

:: Check if we have a remote
git remote get-url origin >nul 2>&1
if %errorlevel% neq 0 (
    echo.
    echo ⚠️  No git remote found!
    echo Please push your code to GitHub first:
    echo.
    echo 1. Create a new repository on GitHub
    echo 2. Run: git remote add origin https://github.com/yourusername/your-repo.git
    echo 3. Run: git push -u origin main
    echo.
    echo Then visit railway.app to deploy!
    pause
    exit /b 1
)

:: Push to remote
echo Pushing to GitHub...
git push

echo.
echo ========================================
echo Repository is ready for Railway!
echo.
echo Next steps:
echo 1. Visit https://railway.app
echo 2. Sign in with GitHub
echo 3. Click "New Project" → "Deploy from GitHub repo"
echo 4. Select your repository
echo 5. Add MySQL database service
echo 6. Set APP_KEY environment variable
echo.
echo Your app will be live in minutes! 🚀
echo ========================================
pause
