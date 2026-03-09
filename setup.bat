@echo off
echo ========================================
echo KDK College Management System Setup
echo ========================================
echo.

echo [1/3] Building Backend...
call mvn clean install
if %errorlevel% neq 0 (
    echo Backend build failed!
    pause
    exit /b %errorlevel%
)

echo.
echo [2/3] Installing Frontend Dependencies...
cd frontend
call npm install
if %errorlevel% neq 0 (
    echo Frontend setup failed!
    pause
    exit /b %errorlevel%
)
cd ..

echo.
echo [3/3] Setup Complete!
echo.
echo ========================================
echo Next Steps:
echo ========================================
echo 1. Configure database in src/main/resources/application.properties
echo 2. Import database schema: mysql -u root -p kdk_college_db ^< database/schema.sql
echo 3. Run backend: start-backend.bat
echo 4. Run frontend: start-frontend.bat
echo.
pause
