# 📋 Student Attendance Management System

A web-based attendance management system built with PHP and MySQL, designed for educational institutions to streamline the process of tracking and reporting student attendance across departments, classes, and subjects.

---

## 📌 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Database Schema](#database-schema)
- [User Roles](#user-roles)
- [Screenshots](#screenshots)
- [Setup & Installation](#setup--installation)
- [Default Credentials](#default-credentials)
- [Contributing](#contributing)
- [License](#license)

---

## Overview

The **Student Attendance Management System** is a role-based web application that enables educational institutions to digitally manage student attendance. It provides three distinct portals — **Principal**, **Head of Department (HOD)**, and **Teacher** — each with dedicated responsibilities and access controls.

The system supports full department, class, subject, and student lifecycle management along with AJAX-powered attendance marking and comprehensive reporting.

---

## ✨ Features

### 🔐 Authentication & Security
- Role-based login for **Principal**, **HOD**, and **Teacher**
- Session-based authentication; every page and AJAX handler checks the signed-in role
- Passwords stored with `password_hash()` (older MD5 hashes are upgraded on login)
- Email OTP for registration and forgot password, verified on the server (PHPMailer)
- Admin verification code required during Principal registration

### 🏛️ Principal Portal
- Add and manage **Departments**
- View the list of all departments and their assigned HODs
- Dashboard statistics (total admin, principals, HODs, teachers, departments)

### 🧑‍💼 HOD Portal
- Add and manage **Classes** (Year 1, 2, 3) within their department
- Assign **Class Teachers** to classes
- Add **Subjects** to classes and assign subject teachers
- View department-wide statistics from the dashboard

### 👩‍🏫 Teacher Portal
- Select class and initiate an **Attendance Session**
- Mark attendance student by student (Present/Absent, with Space / Enter shortcuts)
- View **Attendance Records** per subject and date
- Generate **Attendance Reports** with student-wise percentage, exportable as a spreadsheet (CSV)
- **Add Students** to classes (roll no., enrollment no., name, phone, email)
- View **Student Reports**

### 📧 Email Integration
- PHPMailer integration for OTP, welcome and password-change emails
- SMTP settings come from environment variables; the Docker setup includes a local mail catcher (Mailpit)

---

## 🛠️ Tech Stack

| Layer        | Technology                                    |
|--------------|-----------------------------------------------|
| Backend      | PHP 8.3 (PDO, prepared statements)            |
| Database     | MariaDB 11.4 (MySQL 5.7+ also works)          |
| Frontend     | HTML5, CSS3, Bootstrap 4.1                    |
| JavaScript   | jQuery 3, AJAX (JSON)                         |
| UI Libraries | Font Awesome 4.7, Select2, Animsition, Chart.js, Perfect Scrollbar |
| Email        | PHPMailer                                     |
| Server       | Apache (Docker image `php:8.3-apache`)        |
| Deployment   | Docker Compose (app + database + mail catcher) |

---

## 📁 Project Structure

```
attendence_management/
│
├── index.php                  # Landing page — role selection (Principal / HOD / Teacher)
├── logout.php                 # Ends the session
├── Dockerfile                 # PHP 8.3 + Apache image
├── docker-compose.yml         # App + MariaDB + Mailpit
├── .env.example               # Configuration template
│
├── login/                     # <role>_login.php pages (shared code in _login.php)
├── registration/              # Role chooser + <role>_reg.php wizards (shared code in _register.php)
├── forgot_password/           # <role>_forgot.php pages (shared code in _forgot.php)
│
├── principal/
│   └── index.php              # Principal dashboard — manage departments
│
├── hod/
│   ├── index.php              # HOD dashboard — manage classes, assign class teachers
│   └── subject_add.php        # Add subjects and assign them to teachers
│
├── teacher/
│   ├── index.php              # Choose subject, date and time for attendance
│   ├── mark_attendence.php    # Mark attendance per student
│   ├── attn_report.php        # Choose dates / year for a report
│   ├── attn_display.php       # Attendance report
│   ├── attn_table.php         # Report export (CSV)
│   ├── stud_add.php           # Add student to class (class teacher)
│   └── stud_report.php        # Student list, edit, delete (class teacher)
│
├── sqloperations/             # AJAX backend handlers (JSON responses)
├── validation/                # AJAX checks: email, phone, admin code, OTP
│
├── includes/
│   ├── connection.php         # Database connection (PDO) + query helpers
│   ├── auth.php               # Session, login guards, shared helpers
│   ├── otp.php                # Email OTP (server side)
│   ├── attendance_report.php  # Report calculation
│   ├── layout/                # Shared page layouts (login pages, portals)
│   ├── css/  js/  images/     # Shared styles (app.css), scripts (app.js), images
│   └── vendor/                # Third-party libraries (Bootstrap, jQuery, etc.)
│
├── email/                     # Mailer (PHPMailer)
├── docker/                    # PHP settings used by the Docker image
│
└── database/
    └── student_management.sql # Full database dump (tables + sample data)
```

---

## 🗄️ Database Schema

Database name: **`student_management`**

| Table           | Description                                               |
|-----------------|-----------------------------------------------------------|
| `admin_reg`     | System administrator accounts                             |
| `principal_reg` | Principal user accounts                                   |
| `hod_reg`       | Head of Department accounts with department association   |
| `teacher_reg`   | Teacher accounts with department and class association    |
| `department`    | Departments (e.g., Computer, IT, Electronics)             |
| `class`         | Classes mapped to department, year, and class teacher     |
| `subject`       | Subjects with code, name, type, department, teacher, year |
| `student`       | Student records (roll, enrollment, name, phone, email)    |
| `attendence`    | One row per lecture, one column per student (`S_<enrollment no>`) |
| `details`       | System configuration (e.g., principal verification code)  |

### Key Relationships

```
Department  ──< Class ──< Student
                │
                └──< Subject ──< Attendance Session
                       │
                    Teacher
```

---

## 👤 User Roles

### Principal
- Top-level administrator
- Manages departments and the overall institutional structure
- Can view all registered departments and their HOD assignments

### Head of Department (HOD)
- Manages their specific department
- Creates classes (years), assigns class teachers, manages subject allocation
- Scoped to a single department

### Teacher
- Class-level operator
- Marks daily attendance subject-wise
- Adds students, views and generates reports

---

## ⚙️ Setup & Installation

See **[SETUP.md](SETUP.md)** for detailed step-by-step installation instructions.

**Quick start with Docker:**

```bash
cp .env.example .env
docker compose up -d --build
```

- App: http://localhost:8080
- Mail inbox (OTP emails): http://localhost:8025

The sample database is imported automatically on first start. A manual (XAMPP / LAMP) setup is described in SETUP.md.

---

## 🔑 Default Credentials

> These are pre-loaded in the sample database dump. Change them after first login.

| Role                    | Email                     | Password   |
|-------------------------|---------------------------|------------|
| Principal               | principal@school.edu      | `12345678` |
| HOD (Computer)          | hod.cs@school.edu         | `12345678` |
| HOD (IT)                | hod.it@school.edu         | `12345678` |
| Teacher (class teacher) | john.doe@example.com      | `12345678` |
| Teacher                 | michael.brown@example.com | `12345678` |

> 🔐 The sample accounts ship with legacy MD5 hashes that are replaced by a `password_hash()` hash on first login. Change all credentials before real use.

---

## 🤝 Contributing

Contributions, issues, and feature requests are welcome!

1. Fork the repository
2. Create your feature branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m 'Add some feature'`
4. Push to the branch: `git push origin feature/your-feature`
5. Open a Pull Request

---

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

---

<p align="center">Built with ❤️ for educational institutions</p>
