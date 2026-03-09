-- KDK College Database Schema
-- Database: vipuldb

CREATE DATABASE IF NOT EXISTS vipuldb;
USE vipuldb;

-- Students Table
CREATE TABLE IF NOT EXISTS students (
  id_code INT(30) NOT NULL PRIMARY KEY,
  fname VARCHAR(20) NOT NULL,
  mname VARCHAR(20) NOT NULL,
  lname VARCHAR(20) NOT NULL,
  mob_no INT(10) NOT NULL,
  email VARCHAR(40) NOT NULL UNIQUE,
  adhar_no BIGINT(20) NOT NULL UNIQUE,
  dob DATE NOT NULL,
  address VARCHAR(60) NOT NULL,
  password VARCHAR(50) NOT NULL,
  date_reg DATE NOT NULL,
  profile_photo VARCHAR(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exam Selections Table
CREATE TABLE IF NOT EXISTS exam_selections (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  branch VARCHAR(255) DEFAULT NULL,
  semester VARCHAR(50) DEFAULT NULL,
  subjects TEXT DEFAULT NULL,
  elective VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample Data (Optional)
INSERT INTO students (id_code, fname, mname, lname, mob_no, email, adhar_no, dob, address, password, date_reg) 
VALUES (201, 'Jack', 'Jason', 'William', 1234567894, 'jack@gmail.com', 123456789012, '2003-05-15', 'Nagpur', '201', CURDATE());

INSERT INTO exam_selections (id, branch, semester, subjects, elective) 
VALUES (201, 'cse', '7', 'Cryptography and Network Security, Cryptography and Network Security (Lab)', 'JAVA Programming');
