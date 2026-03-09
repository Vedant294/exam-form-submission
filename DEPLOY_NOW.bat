@echo off
echo ========================================
echo Deploy to GitHub Pages
echo ========================================
echo.

echo [Step 1] Installing gh-pages...
cd frontend
call npm install --save-dev gh-pages

echo.
echo [Step 2] Building and deploying...
call npm run deploy

echo.
echo ========================================
echo Deployment Complete!
echo.
echo Your live demo will be available at:
echo https://vedant294.github.io/kdk-college-management
echo.
echo Wait 2-3 minutes for GitHub Pages to update
echo ========================================
pause
