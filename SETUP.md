# ⚙️ Setup Guide — Student Attendance Management System

This document provides complete, step-by-step instructions to set up the project on your local machine.

---

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

| Requirement | Version       | Notes                                             |
|-------------|---------------|---------------------------------------------------|
| XAMPP       | 5.6.x         | Must include **PHP 5.x** and **MySQL 5.6**        |
| PHP         | 5.5 – 5.6     | Uses deprecated `mysql_*` extension (not in PHP 7+)|
| MySQL       | 5.6           | Bundled with XAMPP                                |
| Apache      | 2.4+          | Bundled with XAMPP                                |
| Browser     | Any modern    | Chrome, Firefox, Edge, etc.                       |

> ⚠️ **Important:** This project uses the `mysql_*` PHP extension which was **removed in PHP 7.0**. You **must** use **PHP 5.x** (via XAMPP 5.6). Using a newer PHP version will cause fatal errors.

---

## 🪜 Step-by-Step Installation

### Step 1 — Download & Install XAMPP

1. Go to the [XAMPP official download page](https://www.apachefriends.org/download.html)
2. Download the **XAMPP 5.6.x** installer for your operating system
3. Run the installer and follow the on-screen prompts
4. Install XAMPP to the default location:
   - **Windows:** `C:\xampp`
   - **macOS:** `/Applications/XAMPP`
   - **Linux:** `/opt/lampp`

---

### Step 2 — Start Apache & MySQL

1. Open the **XAMPP Control Panel**
2. Click **Start** next to **Apache**
3. Click **Start** next to **MySQL**
4. Both services should show a green status indicator

> If port 80 is in use, Apache may fail to start. Change the Apache port in `httpd.conf` or stop the conflicting service.

---

### Step 3 — Clone or Copy the Project

**Option A: Clone via Git**

```bash
cd /path/to/xampp/htdocs
git clone https://github.com/your-username/attendence_management.git
```

**Option B: Manual Copy**

1. Download the project as a ZIP
2. Extract it
3. Move/copy the `attendence_management` folder to your XAMPP `htdocs` directory:
   - **Windows:** `C:\xampp\htdocs\attendence_management`
   - **macOS:** `/Applications/XAMPP/htdocs/attendence_management`
   - **Linux:** `/opt/lampp/htdocs/attendence_management`

---

### Step 4 — Import the Database

1. Open your browser and go to:
   ```
   http://localhost/phpmyadmin
   ```

2. Click **New** in the left sidebar to create a new database

3. Enter the database name:
   ```
   student_management
   ```
   Set collation to `latin1_swedish_ci`, then click **Create**

4. With the `student_management` database selected, click the **Import** tab

5. Click **Choose File** and navigate to:
   ```
   attendence_management/database/student_management.sql
   ```

6. Click **Go** to import the database

7. Verify that the following tables were created:
   - `admin_reg`
   - `attendence`
   - `class`
   - `department`
   - `details`
   - `hod_reg`
   - `principal_reg`
   - `student`
   - `subject`
   - `teacher_reg`

---

### Step 5 — Configure the Database Connection

Open the database connection file:

```
attendence_management/includes/connection.php
```

Update the connection credentials to match your environment:

```php
<?php
$con = mysql_connect("localhost", "root", "");
// Parameters: host, username, password
// Default XAMPP credentials: host=localhost, user=root, password=(empty)

mysql_select_db("student_management", $con);
?>
```

| Parameter | Default Value         | Description             |
|-----------|-----------------------|-------------------------|
| Host      | `localhost`           | MySQL server host       |
| Username  | `root`                | MySQL username          |
| Password  | `""` (empty string)   | MySQL password (blank for default XAMPP) |
| Database  | `student_management`  | The database name       |

> If you have set a custom MySQL root password in XAMPP, update the password field accordingly.

---

### Step 6 — Configure PHPMailer (Optional — for Forgot Password)

The forgot password feature uses **PHPMailer** with SMTP. To enable it:

1. Open the PHPMailer configuration file located in:
   ```
   includes/vendor/phpmailer/src/SSOP.php
   ```

2. Update the SMTP credentials with your email provider details:

   ```php
   $mail->Host = 'smtp.gmail.com';       // SMTP server
   $mail->Username = 'your@gmail.com';   // Sender email
   $mail->Password = 'your-app-password'; // App password (not your login password)
   $mail->Port = 587;
   ```

3. For Gmail, you must:
   - Enable **2-Factor Authentication** on your Google account
   - Generate an **App Password** from [myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords)
   - Use that App Password in the config above

> If you don't need password recovery, you can skip this step. All other features will work normally.

---

### Step 7 — Launch the Application

Open your browser and navigate to:

```
http://localhost/attendence_management/
```

You should see the **role selection landing page** with buttons for:
- **Principal Login**
- **HOD Login**
- **Teacher Login**

---

## 🔑 Default Login Credentials

The database dump includes sample data with the following pre-loaded accounts:

| Role        | Email                       | Password   |
|-------------|-----------------------------|------------|
| Principal   | principal@school.edu        | `12345678` |
| HOD (CS)    | hod.cs@school.edu           | `12345678` |
| HOD (IT)    | hod.it@school.edu           | `12345678` |
| Teacher     | teacher@school.edu          | `12345678` |

> ⚠️ Change these credentials immediately after your first login for security.

---

## 🔄 Registration Flow (New Users)

If you want to register new users instead of using sample accounts:

1. From the landing page, click **"Create your Account"**
2. Select the role you want to register (**Principal**, **HOD**, or **Teacher**)
3. Fill in the registration form
4. **Verification Code Required:** You will be asked for a **Principal Verification Code**
   - The default code stored in the `details` table is: **`ABCD`**
   - This can be updated directly in the database via phpMyAdmin

---

## 🗂️ Suggested First-Time Setup Order

Follow this order after logging in with the sample data or fresh registrations:

```
1. Login as Principal
   └── Add / verify Departments

2. Login as HOD (for each department)
   └── Add Classes (Year 1, Year 2, Year 3)
   └── Assign Class Teachers to each class
   └── Add Subjects and assign Subject Teachers

3. Login as Teacher
   └── Add Students to your class
   └── Start marking Attendance
   └── View Reports
```

---

## 🛠️ Troubleshooting

| Problem | Likely Cause | Solution |
|---|---|---|
| Blank page / PHP errors | Wrong PHP version | Use XAMPP with PHP 5.x |
| `mysql_connect()` undefined | PHP 7+ not supported | Downgrade to PHP 5.6 |
| DB connection error | Wrong credentials | Check `includes/connection.php` |
| Apache won't start | Port 80 conflict | Change port or stop conflicting process |
| Import fails in phpMyAdmin | Wrong DB name | Ensure database is named `student_management` |
| Emails not sending | SMTP misconfigured | Verify App Password and SMTP settings |
| Session not persisting | `session_start()` missing | Ensure not overriding session config |

---

## 📁 File Permissions (Linux/macOS)

If running on Linux or macOS, ensure the project directory has appropriate permissions:

```bash
chmod -R 755 /opt/lampp/htdocs/attendence_management
```

---

## 🔒 Security Recommendations (Before Going Live)

> This project was built for academic/demonstration purposes. Before deploying to a production environment:

- [ ] Migrate from `mysql_*` to `PDO` or `mysqli` with prepared statements (prevents SQL injection)
- [ ] Replace MD5 password hashing with `password_hash()` / `password_verify()`
- [ ] Enable HTTPS via SSL certificate
- [ ] Move `connection.php` credentials to environment variables
- [ ] Remove default/sample database credentials
- [ ] Add CSRF protection to all forms
- [ ] Restrict PHPMailer SMTP credentials using environment variables

---

## 📞 Support

If you encounter any issues not covered in this guide, feel free to open an [Issue](https://github.com/your-username/attendence_management/issues) on the GitHub repository.

---

<p align="center">Happy Teaching! 🎓</p>
