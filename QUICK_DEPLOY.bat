@echo off
echo ========================================
echo Quick Deploy to Vercel
echo ========================================
echo.

echo Installing Vercel CLI...
call npm install -g vercel

echo.
echo Building frontend...
cd frontend
call npm run build

echo.
echo Deploying to Vercel...
call vercel --prod

echo.
echo ========================================
echo Deployment Complete!
echo Copy the URL shown above
echo ========================================
pause
