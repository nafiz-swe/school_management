# Laravel + React Starter Kit
## License

The Laravel + React starter kit is open-sourced software licensed under the MIT license.

# School Management Systems
# ###################################
#### 🎯 প্রজেক্ট: School Management System (Full Stack)

#### Tech Stack:
Backend: Laravel (RESTful API সহ)
Frontend: React
Database: MySQL
Authentication: Laravel Sanctum / JWT
Version Control: Git
Optional: CodeIgniter (for comparison or alternative module)

📚 মডিউলসমূহ (ফিচার অনুযায়ী ভাগ করা)
####  1. User & Role Management
Admin, Teacher, Student, Guardian, Accountant
Role-based access control (RBAC)
Login / Logout / Register (via API)
Password reset system

#### 🏫 2. Academic Management
Class, Section, Subject CRUD
Teacher assign to class & subject
Student admission form
Attendance system (manual + API)

#### 📊 3. Result & Exam Management
Exam create/update/delete
Marks entry per subject
Auto result calculation via backend API
Result view in student dashboard

#### 💰 4. Fees & Accounts
Fee category, assign fee, payment history
Payment via API (Bkash/Nagad simulation)
Invoice PDF generation

#### 📅 5. Routine & Notice
Class routine by teacher
Noticeboard for admin
API endpoint for frontend display

#### 📨 6. Communication
Message between teacher & student (AJAX chat)
Push notification (optional)

# ##
#### Sanctum ইনস্টল (Authentication এর জন্য)
composer require laravel/sanctum
#
php artisan migrate
#
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
# ##

# ##
## 1️⃣ Laravel Project 30% Overview
✔️ Laravel installed (composer create-project)
✔️ .env configured
✔️ Database connected

2️⃣ Authentication (Laravel Sanctum)

✔️ Register
✔️ Login
✔️ Logout
✔️ Token system (Bearer Token)
👉 মানে frontend বা Postman থেকে সহজেই authorized API request পাঠানো যাবে

3️⃣ Models + Migrations

✔️ User
✔️ ClassRoom
✔️ Subject
✔️ Student
✔️ ExamResult

✅ এখন সব foreign key constraint ঠিক করা হয়েছে
✅ php artisan migrate:fresh দিলে সব টেবিল তৈরি হবে

4️⃣ Controllers (API version)

✔️ AuthController → Register, Login, Logout ✅
✔️ StudentController → CRUD (Create, Read, Update, Delete) ✅

5️⃣ Routes (routes/api.php)

✔️ Public routes → /register, /login
✔️ Protected routes → /logout, /students (CRUD) ✅
