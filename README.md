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
- Session-based authentication with redirect guards
- MD5-hashed passwords stored in the database
- Forgot password flow via email (PHPMailer)
- Principal verification code required during HOD/Teacher registration

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
- Mark attendance for up to **100 students** per session (Present/Absent)
- View **Attendance Records** per subject and date
- Generate **Attendance Reports** with student-wise percentage
- **Add Students** to classes (roll no., enrollment no., name, phone, email)
- View **Student Reports**

### 📧 Email Integration
- PHPMailer integration for password recovery emails

---

## 🛠️ Tech Stack

| Layer        | Technology                                    |
|--------------|-----------------------------------------------|
| Backend      | PHP 5.5 (legacy `mysql_*` extension)          |
| Database     | MySQL 5.6                                     |
| Frontend     | HTML5, CSS3, Bootstrap 4.1                    |
| JavaScript   | jQuery 3.2.1, AJAX                            |
| UI Libraries | Font Awesome 4.7 & 5, Select2, Animsition, Chart.js, Perfect Scrollbar |
| Email        | PHPMailer                                     |
| Server       | Apache (XAMPP / WAMP recommended)             |

> ⚠️ **Note:** This project uses the deprecated `mysql_*` PHP extension, which requires **PHP 5.x**. PHP 7+ dropped support for this extension. Use XAMPP with PHP 5.x or configure accordingly.

---

## 📁 Project Structure

```
attendence_management/
│
├── index.php                  # Landing page — role selection (Principal / HOD / Teacher)
│
├── login/
│   ├── principal_login.php    # Principal login form & authentication
│   ├── hod_login.php          # HOD login form & authentication
│   └── teacher_login.php      # Teacher login form & authentication
│
├── registration/
│   ├── index.php              # Registration role selection
│   ├── principal_reg.php      # Principal registration form
│   ├── hod_reg.php            # HOD registration form
│   └── teacher_reg.php        # Teacher registration form
│
├── principal/
│   ├── index.php              # Principal dashboard — manage departments
│   └── admin_includes/        # Sidebar, header, footer partials
│
├── hod/
│   ├── index.php              # HOD dashboard — manage classes
│   ├── subject_add.php        # Add and assign subjects to teachers
│   └── admin_includes/        # Sidebar, header, footer partials
│
├── teacher/
│   ├── index.php              # Teacher dashboard — start attendance
│   ├── sub_select.php         # Subject selection for attendance
│   ├── mark_attendence.php    # Mark attendance per student
│   ├── attn_display.php       # View attendance records
│   ├── attn_report.php        # Attendance report generation
│   ├── attn_table.php         # Attendance table view
│   ├── stud_add.php           # Add student to class
│   └── stud_report.php        # Student report view
│
├── sqloperations/             # AJAX backend handlers (PHP scripts)
│   ├── login.php
│   ├── insert_reg.php
│   ├── insert_dept.php
│   ├── insert_class.php
│   ├── insert_subject.php
│   ├── insert_student.php
│   ├── mark_attendence.php
│   ├── get_stud_data.php
│   ├── add_class_tech.php
│   ├── add_subject_tech.php
│   └── update_reg.php
│
├── includes/
│   ├── connection.php         # MySQL database connection
│   ├── css/                   # Global styles
│   ├── js/                    # Global scripts
│   ├── images/                # Shared images/icons
│   └── vendor/                # Third-party libraries (Bootstrap, jQuery, etc.)
│
├── forgot_password/           # Forgot password flow
├── email/                     # Email templates / handlers
├── validation/                # Client-side validation scripts
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
| `attendence`    | Per-session attendance records for up to 100 students     |
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

**Quick summary:**
1. Install XAMPP (PHP 5.x compatible)
2. Clone/copy the project to `htdocs/attendence_management`
3. Import `database/student_management.sql` in phpMyAdmin
4. Configure `includes/connection.php` with your DB credentials
5. Visit `http://localhost/attendence_management/`

---

## 🔑 Default Credentials

> These are pre-loaded in the sample database dump. Change them after first login.

| Role      | Email                         | Password   |
|-----------|-------------------------------|------------|
| Principal | principal@school.edu          | `12345678` |
| HOD (CS)  | hod.cs@school.edu             | `12345678` |
| HOD (IT)  | hod.it@school.edu             | `12345678` |
| Teacher   | teacher@school.edu            | `12345678` |

> 🔐 Passwords are stored as MD5 hashes. The hash `25d55ad283aa400af464c76d713c07ad` corresponds to `12345678`. Update all credentials after first login.

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
