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

#### ✅ Overview:
এই প্রজেক্টে Laravel ব্যবহার করে Student Management System তৈরি করা হয়েছে। Web এবং API উভয় ইন্টারফেসে CRUD operations support করে।
Web Controller Blade views render করে, API Controller JSON response return করে।

#### ✅ Features:
Students CRUD (Create, Read, Update, Delete)

ClassRoom relation (Student belongsTo ClassRoom)

Photo upload & replace support

Validation handled professionally via Form Request (Web) এবং Validator (API)

Pagination for listing students

#### ✅ Folder / File Structure:
app/Http/Controllers/StudentController.php → Web CRUD
app/Http/Controllers/Api/StudentApiController.php → API CRUD
app/Http/Requests/StoreStudentRequest.php → Web store validation
app/Http/Requests/UpdateStudentRequest.php → Web update validation
app/Models/Student.php → Model with fillable fields & relation with ClassRoom
app/Models/ClassRoom.php → Model for class_rooms table

#### ✅ Installation Steps:

Laravel install করতে হবে, তারপর project open করতে হবে VS Code এ

.env ফাইলে database config set করতে হবে

Migration তৈরি করতে হবে Student এবং ClassRoom model দিয়ে

Migration run করতে হবে php artisan migrate দিয়ে

#### ✅ Controller & Request:
Web Controller এ Store এবং Update এর জন্য Form Request use করা হয়েছে professional validation এর জন্য
API Controller এ Validator::make() দিয়ে Web এর মতো full validation handle করা হয়েছে, JSON response structured: status, message, data

#### ✅ Routes:
Web: Route::resource('students', StudentController::class)
API: Route::apiResource('students', App\Http\Controllers\Api\StudentApiController::class)

#### ✅ Views (Web):
resources/views/students/index.blade.php → List students
resources/views/students/create.blade.php → Create student form
resources/views/students/edit.blade.php → Edit student form

#### ✅ CRUD Workflow:

Create → Web: StudentController@store, API: StudentApiController@store, Validation: StoreStudentRequest/Web Validator

Read → Web: StudentController@index & show, API: StudentApiController@index & show

Update → Web: StudentController@update, API: StudentApiController@update, Validation: UpdateStudentRequest/Web Validator

Delete → Web: StudentController@destroy, API: StudentApiController@destroy

Photo → Upload & replace handled both in Web and API

#### ✅ Commands Reference:

Make Model + Migration: php artisan make:model Student -m এবং php artisan make:model ClassRoom -m

Make Controller: php artisan make:controller StudentController এবং php artisan make:controller Api/StudentApiController

Make Form Request: php artisan make:request StoreStudentRequest এবং php artisan make:request UpdateStudentRequest

Run Migration: php artisan migrate

Run Project: php artisan serve

#### ✅ Notes:

একটাই Student model দিয়ে Web এবং API Controller দুই-ই handle করে। আলাদা model লাগেনা।

Web Controller Blade views render করে

API Controller JSON response return করে

Photo upload & validation দুই-ই handled professionally

Form Requests Web এ professional validation maintain করে

API Controller এ Validator::make() দিয়ে Web এর মতো validation handled


# ##

## Laravel Important Commands & Usage
এই file টি Laravel project এর জন্য গুরুত্বপূর্ণ commands এবং তাদের কাজ সংক্ষেপে দেখায়। README বা note হিসেবে ব্যবহার করা যাবে।

#### Cache & Optimization Commands
php artisan optimize:clear       # সব cache clear করে (config, route, view, cache)
php artisan cache:clear          # শুধুমাত্র application cache clear করে
php artisan config:cache         # config files cache করে, performance বাড়ায়
php artisan route:cache          # route cache করে, route loading দ্রুত হয়
php artisan view:clear           # Blade view cache clear করে

#### Database & Migration Commands
php artisan migrate              # সব migration run করে, database table create/update
php artisan migrate:fresh        # সব table drop করে আবার migrate run করে, clean start
php artisan migrate:rollback     # শেষ migration undo করে
php artisan migrate:reset        # সব migration undo করে database empty করে
php artisan make:migration create_products_table   # নতুন migration file create
php artisan make:model Product -m                 # Model এবং migration একসাথে create
php artisan db:seed              # Seeder run করে database এ data insert
php artisan db:seed --class=ProductSeeder  # নির্দিষ্ট seeder run করে

#### Controller & Request Commands
php artisan make:controller ProductController          # নতুন Controller create
php artisan make:controller Api/ProductApiController  # নতুন API Controller create
php artisan make:request StoreProductRequest          # Form Request for store validation
php artisan make:request UpdateProductRequest         # Form Request for update validation

#### Factory & Seeder Commands
php artisan make:factory ProductFactory       # Factory create করে fake data generate
php artisan make:seeder ProductSeeder         # Seeder create করে demo/default data insert

#### Middleware & Event Commands
php artisan make:middleware CheckAdmin        # নতুন middleware create
php artisan make:event UserRegistered         # নতুন Event class create
php artisan make:listener SendWelcomeEmail    # নতুন Listener create
php artisan event:generate                     # Event & Listener scaffold create

#### Server & Development Commands
php artisan serve                # Laravel local server start (http://127.0.0.1:8000)
php artisan tinker               # Interactive shell, code test বা Eloquent query run
composer install                 # composer dependency install
composer update                  # composer dependency update
npm install                       # Node dependency install
npm run dev                        # Frontend assets compile & watch
npm run build                      # Production ready assets compile
php artisan storage:link           # storage/public link create, uploaded file access
php artisan key:generate           # App key generate করে .env file এ set হয়
php artisan queue:work             # Queue jobs process
php artisan queue:listen           # Queue jobs continuously listen & process

#### Route Commands
php artisan route:list             # সব route দেখাবে, method, uri, name, middleware সহ


#### ✅ Note:
Controller, Model, Migration, Request file create করার সময় naming convention অনুসরণ করলে project maintain করা সহজ হয়।

Seeder এবং Factory ব্যবহার করলে dummy/demo data দ্রুত তৈরি করা যায়।

Cache, config, route clear ও cache করা হলে performance বৃদ্ধি পায়।

php artisan migrate:fresh ব্যবহার করলে সব data loss হয়, শুধুমাত্র development/testing এর জন্য ব্যবহার করা ভালো।
# ##
#### Maintainer: Nafizul Islam
#### Project: Student Management System (Laravel)