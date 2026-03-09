@echo off
echo ========================================
echo Automated GitHub Deployment
echo ========================================
echo.

echo Opening GitHub to create repository...
echo.
echo Please:
echo 1. Login to GitHub if needed
echo 2. Repository name: kdk-college-management
echo 3. Make it PUBLIC
echo 4. Click "Create repository"
echo.

start https://github.com/new

echo.
echo Waiting for you to create the repository...
echo Press any key AFTER you create the repository on GitHub...
pause

echo.
echo ========================================
echo Deploying Your Project...
echo ========================================
echo.

echo [1/4] Updating Git remote...
git remote remove origin 2>nul
git remote add origin https://github.com/Vedant294/kdk-college-management.git
echo Done!

echo.
echo [2/4] Pushing to GitHub...
git push -u origin main
if %errorlevel% neq 0 (
    echo.
    echo ERROR: Push failed. Please check:
    echo 1. Repository was created
    echo 2. You're logged in to GitHub
    echo 3. Repository name is: kdk-college-management
    pause
    exit /b 1
)
echo Done!

echo.
echo [3/4] Installing deployment tools...
cd frontend
call npm install --save-dev gh-pages
echo Done!

echo.
echo [4/4] Deploying to GitHub Pages...
call npm run deploy
cd ..

echo.
echo ========================================
echo DEPLOYMENT COMPLETE!
echo ========================================
echo.
echo Repository: https://github.com/Vedant294/kdk-college-management
echo.
echo FINAL STEP - Enable GitHub Pages:
echo Opening settings page...
start https://github.com/Vedant294/kdk-college-management/settings/pages
echo.
echo On the page that opened:
echo 1. Source: Deploy from a branch
echo 2. Branch: gh-pages
echo 3. Click Save
echo.
echo Your live demo will be at:
echo https://vedant294.github.io/kdk-college-management
echo.
echo Wait 2-3 minutes after enabling GitHub Pages!
echo ========================================
pause
