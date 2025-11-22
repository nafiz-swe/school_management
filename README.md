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


## APP pass
EMAIL_ADDRESS = "?????????@gmail.com"
EMAIL_PASSWORD = "jwnwzwaolgnadxfq"

# ##

## Student Management System (Laravel) - Web & API

#### Overview:
এই প্রজেক্টে Laravel ব্যবহার করে Student Management System তৈরি করা হয়েছে। Web এবং API উভয় ইন্টারফেসে CRUD operations support করে।
Web Controller Blade views render করে, API Controller JSON response return করে।

#### Features:
Students CRUD (Create, Read, Update, Delete)

ClassRoom relation (Student belongsTo ClassRoom)

Photo upload & replace support

Validation handled professionally via Form Request (Web) এবং Validator (API)

Pagination for listing students

#### Folder / File Structure:
app/Http/Controllers/StudentController.php → Web CRUD
app/Http/Controllers/Api/StudentApiController.php → API CRUD
app/Http/Requests/StoreStudentRequest.php → Web store validation
app/Http/Requests/UpdateStudentRequest.php → Web update validation
app/Models/Student.php → Model with fillable fields & relation with ClassRoom
app/Models/ClassRoom.php → Model for class_rooms table

#### Installation Steps:

Laravel install করতে হবে, তারপর project open করতে হবে VS Code এ

.env ফাইলে database config set করতে হবে

Migration তৈরি করতে হবে Student এবং ClassRoom model দিয়ে

Migration run করতে হবে php artisan migrate দিয়ে

#### Controller & Request:
Web Controller এ Store এবং Update এর জন্য Form Request use করা হয়েছে professional validation এর জন্য
API Controller এ Validator::make() দিয়ে Web এর মতো full validation handle করা হয়েছে, JSON response structured: status, message, data

#### Routes:
Web: Route::resource('students', StudentController::class)
API: Route::apiResource('students', App\Http\Controllers\Api\StudentApiController::class)

#### Views (Web):
resources/views/students/index.blade.php → List students
resources/views/students/create.blade.php → Create student form
resources/views/students/edit.blade.php → Edit student form

#### CRUD Workflow:

Create → Web: StudentController@store, API: StudentApiController@store, Validation: StoreStudentRequest/Web Validator

Read → Web: StudentController@index & show, API: StudentApiController@index & show

Update → Web: StudentController@update, API: StudentApiController@update, Validation: UpdateStudentRequest/Web Validator

Delete → Web: StudentController@destroy, API: StudentApiController@destroy

Photo → Upload & replace handled both in Web and API

#### Commands Reference:

Make Model + Migration: php artisan make:model Student -m এবং php artisan make:model ClassRoom -m

Make Controller: php artisan make:controller StudentController এবং php artisan make:controller Api/StudentApiController

Make Form Request: php artisan make:request StoreStudentRequest এবং php artisan make:request UpdateStudentRequest

Run Migration: php artisan migrate

Run Project: php artisan serve

#### Notes:

একটাই Student model দিয়ে Web এবং API Controller দুই-ই handle করে। আলাদা model লাগেনা।

Web Controller Blade views render করে

API Controller JSON response return করে

Photo upload & validation দুই-ই handled professionally

Form Requests Web এ professional validation maintain করে

API Controller এ Validator::make() দিয়ে Web এর মতো validation handled
# ##
#### Maintainer: Nafiz Noyon
#### Project: Student Management System (Laravel)