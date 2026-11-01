# Medical Archives — PHP + MySQL Connected Project

This version uses **PHP 8+ (PDO) as both the frontend runtime and backend**, with MySQL. The previous Python/Flask backend is no longer needed for this PHP version.

## Project structure
- `index.php` — Admin / Customer entry page
- `admin/login.php`, `admin/dashboard.php` — Admin portal
- `customer/login.php`, `customer/dashboard.php` — Customer portal
- `api/index.php` — PHP JSON API (authentication, doctors, customers, medicines, prescriptions, medication history, activity logs)
- `includes/db.php` — PDO MySQL connection
- `includes/session.php` — secure PHP session helpers
- `database/medical_archives_schema.sql` — base MySQL schema
- `database/migration_php_auth.sql` — adds usernames and makes customer contact number optional for registration

## Setup with XAMPP
1. Install XAMPP and start Apache + MySQL.
2. Copy this folder to `C:\xampp\htdocs\Medical_Archives_PHP_Connected`.
3. Open phpMyAdmin, create/import the database by importing `database/medical_archives_schema.sql`.
4. Then run `database/migration_php_auth.sql` once in phpMyAdmin (adds `username` to customer/admin and allows contact number to be blank).
5. Check `includes/db.php`; default local XAMPP settings are host `127.0.0.1`, database `medical_archives_db`, user `root`, blank password.
6. Open `http://localhost/Medical_Archives_PHP_Connected/`.
7. Create an admin account through Admin > Create Account, then create a customer account.

## API routes
- `GET api/health`
- `POST api/auth/register/customer`, `POST api/auth/register/admin`
- `POST api/auth/login/customer`, `POST api/auth/login/admin`
- `POST api/auth/logout`, `GET api/auth/me`
- `GET api/doctors`, `POST api/doctors`
- `GET api/customers`, `GET api/medicines`, `POST api/medicines`
- `GET api/prescriptions`, `POST api/prescriptions`
- `GET api/medication-history`, `GET api/activity-logs`

The Add Prescription form loads real customer, doctor, and medicine options from MySQL. Saving creates a prescription linked to `customer_id`, `doctor_id`, and `medicine_id`, creates medication history and instruction rows, and updates stock when status is `dispensed`.

## Notes / limitations
- Existing visual dashboards were retained. The login/register flow and Add Prescription workflow are connected to MySQL. Some older dashboard editing widgets still contain browser-local demo behavior and should be migrated to API calls before production use.
- Google sign-in is a UI placeholder; it requires Google OAuth client configuration and server-side token verification.
- This project is intended for local development/testing. Before public deployment, configure HTTPS, secure secrets, CSRF protection for state-changing requests, backups, role review, audit retention, and privacy controls. Do not put real patient data into a demo deployment.
- Traditional PHP/MySQL requires a PHP-capable host. Vercel does not natively host a conventional PHP + MySQL application; use XAMPP locally or a PHP hosting provider / configured external PHP runtime and managed MySQL.
