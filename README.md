# KDK College Management System

Full-stack student management system for KDK College of Engineering, Nagpur.

## 🚀 Live Demo

**Live Demo:** https://vedant294.github.io/kdk-college-management

**Test Credentials:**
- Email: `jack@gmail.com`
- Password: `201`

## 🛠️ Tech Stack

**Backend:** Java 17, Spring Boot 3.2.0, Spring Data JPA, MySQL  
**Frontend:** React 18, React Router, Axios, Tailwind CSS

## ⚡ Quick Start

### 1. Database Setup
```bash
mysql -u root -p
CREATE DATABASE vipuldb;
USE vipuldb;
source database/schema.sql;
```

### 2. Backend Setup
```bash
# Update MySQL password in src/main/resources/application.properties
mvn spring-boot:run
```
Backend: http://localhost:8080

### 3. Frontend Setup
```bash
cd frontend
npm install
npm start
```
Frontend: http://localhost:3000

## 📡 API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/auth/login` | Student login |
| POST | `/api/auth/signup` | Student registration |
| GET | `/api/students/{id}` | Get student profile |
| PUT | `/api/students/{id}` | Update profile |
| POST | `/api/exams` | Submit exam form |
| GET | `/api/exams` | Get exam submissions |

## ✨ Features

- 🔐 Authentication (Login/Signup)
- 📊 Student Dashboard
- ✏️ Profile Management
- 📝 Exam Form Submission
- 💳 Payment Integration
- 🧾 Fee Receipt

## 📂 Project Structure

```
├── src/main/java/com/kdk/college/    # Spring Boot Backend
│   ├── controller/                    # REST APIs
│   ├── model/                         # JPA Entities
│   ├── repository/                    # Data Access
│   ├── service/                       # Business Logic
│   └── dto/                           # Data Transfer Objects
├── frontend/src/                      # React Frontend
│   ├── components/                    # UI Components
│   ├── pages/                         # Page Components
│   └── services/                      # API Services
└── database/schema.sql                # MySQL Schema
```

## 📄 License

© 2025 KDK College of Engineering, Nagpur
