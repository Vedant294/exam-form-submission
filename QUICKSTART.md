# Quick Start Guide - Preview Application

## Prerequisites

### 1. Install Java 17
Download from: https://www.oracle.com/java/technologies/downloads/#java17
Verify: `java -version`

### 2. Install Maven
Download from: https://maven.apache.org/download.cgi
Add to PATH and verify: `mvn -version`

### 3. Install Node.js
Download from: https://nodejs.org/
Verify: `node -v` and `npm -v`

### 4. Install MySQL
Download from: https://dev.mysql.com/downloads/mysql/

## Step 1: Setup MySQL Database

### Option A - If MySQL is installed:
```bash
# Login to MySQL (enter your password when prompted)
mysql -u root -p

# Create database and import schema
CREATE DATABASE vipuldb;
USE vipuldb;
source database/schema.sql;
exit;
```

### Option B - If MySQL is NOT installed:
Download and install MySQL from: https://dev.mysql.com/downloads/mysql/

## Step 2: Update MySQL Password

Edit `src/main/resources/application.properties` line 6:
```properties
spring.datasource.password=YOUR_MYSQL_PASSWORD
```

## Step 3: Start Backend

**Option A - Using script:**
```bash
start-backend.bat
```

**Option B - Using Maven:**
```bash
mvn spring-boot:run
```

Wait for: `Started KdkCollegeApplication in X seconds`

Backend will run on: http://localhost:8080

## Step 4: Start Frontend

Open a NEW terminal:

```bash
cd frontend
npm install
npm start
```

Frontend will open automatically at: http://localhost:3000

## Step 5: Login

Use test credentials:
- Email: `jack@gmail.com`
- Password: `201`

## Troubleshooting

### MySQL Connection Error
- Check MySQL is running: `net start MySQL80`
- Verify password in application.properties
- Ensure database 'vipuldb' exists

### Port Already in Use
- Backend (8080): Change port in application.properties
- Frontend (3000): It will prompt to use 3001

### npm install fails
- Delete `frontend/node_modules` folder
- Run `npm install` again
