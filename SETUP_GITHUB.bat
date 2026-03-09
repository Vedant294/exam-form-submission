@echo off
echo ========================================
echo Setup GitHub Repository
echo ========================================
echo.
echo STEP 1: Create Repository on GitHub
echo ------------------------------------
echo 1. Go to: https://github.com/new
echo 2. Repository name: kdk-college-management
echo 3. Description: Full-Stack Student Management System - Java Spring Boot + React + MySQL
echo 4. Make it PUBLIC
echo 5. DO NOT initialize with README
echo 6. Click "Create repository"
echo.
pause
echo.

echo STEP 2: Changing Remote URL...
git remote remove origin
git remote add origin https://github.com/Vedant294/kdk-college-management.git
echo Remote updated!
echo.

echo STEP 3: Pushing to GitHub...
git push -u origin main
echo.

echo STEP 4: Installing gh-pages for deployment...
cd frontend
call npm install --save-dev gh-pages
echo.

echo STEP 5: Deploying to GitHub Pages...
call npm run deploy
cd ..
echo.

echo ========================================
echo SUCCESS!
echo ========================================
echo.
echo Your repository: https://github.com/Vedant294/kdk-college-management
echo.
echo Now enable GitHub Pages:
echo 1. Go to: https://github.com/Vedant294/kdk-college-management/settings/pages
echo 2. Source: Deploy from a branch
echo 3. Branch: gh-pages
echo 4. Click Save
echo.
echo Your live demo will be at:
echo https://vedant294.github.io/kdk-college-management
echo.
echo Wait 2-3 minutes for it to go live!
echo ========================================
pause
