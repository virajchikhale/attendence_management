# ⚙️ Setup Guide — Student Attendance Management System

Two ways to run the project: **Docker** (recommended, nothing else to install) or a **manual** PHP + PostgreSQL stack.

---

## 🐳 Option A — Docker (recommended)

### Prerequisites

| Requirement    | Version | Notes                               |
|----------------|---------|-------------------------------------|
| Docker Engine  | 20.10+  | or Docker Desktop                   |
| Docker Compose | v2      | `docker compose` (bundled with Docker Desktop) |

### Steps

```bash
git clone https://github.com/virajchikhale/attendence_management.git
cd attendence_management

cp .env.example .env        # optional: change ports / passwords
docker compose up -d --build
```

| Service  | URL                     | What it is                                        |
|----------|-------------------------|---------------------------------------------------|
| App      | http://localhost:8080   | The attendance system                             |
| Mailpit  | http://localhost:8025   | Inbox that catches every email the app sends (OTP codes land here) |
| Database | internal only (`db`)    | PostgreSQL 16, data kept in the `pg_data` volume  |

The sample database (`database/student_management.sql`) is imported automatically the **first** time the database volume is created.

### Useful commands

```bash
docker compose logs -f app      # PHP / Apache log (errors are logged here, not shown in the browser)
docker compose down             # stop, keep data
docker compose down -v          # stop and delete the database volume (next "up" re-imports the sample data)
docker compose up -d --build    # rebuild after changing code
docker compose exec db psql -U attendance student_management   # SQL prompt
```

### Dummy attendance data

For a fuller demo, load 8 weeks of randomised attendance for the sample subjects (safe to re-run; it replaces its own rows):

```bash
docker compose exec -T db psql -U attendance student_management < database/seed_dummy_data.sql
```

### Configuration (`.env`)

| Variable            | Default                      | Description                                  |
|---------------------|------------------------------|----------------------------------------------|
| `APP_PORT`          | `8080`                       | Host port for the app                        |
| `APP_TIMEZONE`      | `Asia/Kolkata`               | PHP timezone                                 |
| `DB_NAME`           | `student_management`         | Database name                                |
| `DB_USER`           | `attendance`                 | Database user used by the app                |
| `DB_PASSWORD`       | `attendance`                 | Its password — **change for real use**       |
| `MAILPIT_PORT`      | `8025`                       | Host port for the Mailpit inbox              |
| `SMTP_HOST`         | `mailpit`                    | SMTP server                                  |
| `SMTP_PORT`         | `1025`                       | SMTP port                                    |
| `SMTP_SECURE`       | `none`                       | `tls`, `ssl` or `none`                       |
| `SMTP_USER` / `SMTP_PASSWORD` | empty              | SMTP login, if the server needs one          |
| `MAIL_FROM`         | `no-reply@attendance.local`  | Sender address                               |
| `MAIL_FROM_NAME`    | `Student Management`         | Sender name                                  |

> The database name, user and password are only applied when the volume is first created. To change them later, run `docker compose down -v` first (this deletes the data) or change them inside PostgreSQL.

### Sending real email (e.g. Gmail)

Set these in `.env` and run `docker compose up -d`:

```env
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_SECURE=tls
SMTP_USER=you@gmail.com
SMTP_PASSWORD=your-app-password
MAIL_FROM=you@gmail.com
```

For Gmail, enable 2-Factor Authentication and create an **App Password** at [myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords). Never commit `.env` — it is git-ignored.

---

## 🧰 Option B — Manual setup

### Prerequisites

| Requirement | Version      | Notes                                   |
|-------------|--------------|-----------------------------------------|
| PHP         | 8.1 or newer | with the `pdo_pgsql` extension          |
| PostgreSQL  | 12 or newer  |                                         |
| Apache      | 2.4+         | `.htaccess` support (`AllowOverride All`) recommended |

### Steps

1. Copy the project into your web root (e.g. `htdocs/attendence_management`).
2. Create the database and import the schema and sample data:

   ```bash
   createdb -U postgres student_management
   psql -U postgres -d student_management -f database/student_management.sql
   ```

3. The app connects to `localhost:5432` as `postgres` with an empty password by default. To use anything else, set the `DB_*` environment variables listed above for the web server, e.g. in Apache:

   ```apache
   SetEnv DB_HOST 127.0.0.1
   SetEnv DB_PORT 5432
   SetEnv DB_USER attendance
   SetEnv DB_PASSWORD secret
   SetEnv DB_NAME student_management
   ```

   The database user must own the tables: adding a student adds a column to the `attendence` table.

4. Email (OTP for registration and password reset) needs the `SMTP_*` variables set the same way. Without `SMTP_HOST`, no email is sent and OTP steps cannot be completed.
5. Open `http://localhost/attendence_management/`.

### Coming from the old MySQL database

The app no longer connects to MySQL. Data in an existing MySQL database is **not** migrated automatically. The PostgreSQL schema differs from the old dump in a few column types, so load the new schema first and copy the rows across (a tool such as [pgloader](https://pgloader.io/) in data-only mode can do this):

| Column                                             | MySQL          | PostgreSQL                 |
|----------------------------------------------------|----------------|----------------------------|
| `attendence.date`, `attendence.time`               | varchar, time(6) | `date`, `time`           |
| `attendence.subject`                               | varchar        | `integer`                  |
| `hod_reg.department_id`, `teacher_reg.department_id` | text         | `integer`                  |
| `hod_reg.report_to`, `teacher_reg.report_to`       | text           | `integer` (empty → `NULL` for teachers) |
| `attendence.S_<enrollment no>`                     | case-insensitive names | quoted, case-sensitive names |

Existing MD5 password hashes keep working: each account is upgraded to a modern hash the next time it logs in.

---

## 🔑 Default Login Credentials

The sample data includes these accounts (password `12345678` for all):

| Role                    | Email                        |
|-------------------------|------------------------------|
| Principal               | principal@school.edu         |
| HOD (Computer)          | hod.cs@school.edu            |
| HOD (IT)                | hod.it@school.edu            |
| Teacher (class teacher) | john.doe@example.com         |
| Teacher                 | michael.brown@example.com    |

> ⚠️ Change these credentials before using the system for real.

---

## 🔄 Registration Flow (New Users)

1. From the landing page, click **"Create your Account"** and pick a role.
2. Fill in your details. HODs pick a department that has no HOD yet; teachers pick their department.
3. **Principal only:** enter the **Admin Verification Code** — the value stored in the `details` table (default `ABCD`).
4. On the last step click **Send OTP**, read the code from your inbox (Mailpit at http://localhost:8025 in the default Docker setup), enter it and click **Register**.

---

## 🗂️ Suggested First-Time Setup Order

```
1. Login as Principal
   └── Add Departments

2. Register / login as HOD (one per department)
   └── Add Classes (First, Second, Third Year)
   └── Assign a Class Teacher to each class
   └── Add Subjects and assign Subject Teachers

3. Login as Teacher
   └── Class teacher: add Students to the class
   └── Mark Attendance for your subjects
   └── View / export Reports
```

---

## 🛠️ Troubleshooting

| Problem | Likely Cause | Solution |
|---|---|---|
| "could not connect to its database" | DB not ready or wrong credentials | `docker compose ps` (db must be *healthy*); check `DB_*` values |
| Database from an earlier MariaDB version of this stack | Old `db_data` volume is no longer used | The PostgreSQL data lives in a new `pg_data` volume and starts from the sample data; remove the old volume with `docker volume rm` once you no longer need it |
| Port already in use | 8080 / 8025 taken | Change `APP_PORT` / `MAILPIT_PORT` in `.env` |
| No OTP email | SMTP not reachable | Check Mailpit at :8025, or your `SMTP_*` settings; see `docker compose logs app` |
| Blank page / error 500 | PHP error | Errors are logged, not displayed: `docker compose logs app` |
| Changed `DB_PASSWORD` and app cannot connect | Password only applied on first start | `docker compose down -v` and start again (deletes data) |
| Sample data missing | Volume created before the dump was mounted | `docker compose down -v && docker compose up -d` |

---

## 🔒 Security Notes

Already in place:

- All SQL goes through PDO prepared statements
- Passwords hashed with `password_hash()` (legacy MD5 hashes upgraded on login)
- OTP generated and verified on the server, limited attempts, 10 minute lifetime
- Every portal page and AJAX handler checks the signed-in role
- Database and mail credentials come from environment variables, not source code

Still recommended before going live:

- [ ] Serve over HTTPS (reverse proxy in front of the container)
- [ ] Change the default database passwords and the sample account passwords
- [ ] Change the principal verification code in the `details` table
- [ ] Add CSRF tokens to forms (session cookies are already `SameSite=Lax`)

---

## 📞 Support

If you encounter any issues not covered in this guide, feel free to open an [Issue](https://github.com/virajchikhale/attendence_management/issues) on the GitHub repository.

---

<p align="center">Happy Teaching! 🎓</p>
