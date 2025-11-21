<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->foreignId('class_id')->constrained('class_rooms')->cascadeOnDelete();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('student_phone', 20);
            $table->string('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->string('guardian_email')->nullable();
            $table->string('guardian_relationship')->nullable();
            $table->date('enrollment_date')->nullable();
            $table->string('status')->default('active');
            $table->string('photo_path')->nullable();
            $table->string('roll_number')->nullable()->unique();
            $table->string('admission_number')->nullable()->unique();
            $table->string('blood_group')->nullable();
            $table->string('national_id')->nullable()->unique();
            $table->string('religion')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->string('previous_school')->nullable();
            $table->string('medical_conditions')->nullable();
            $table->string('allergies')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('father_profession')->nullable();
            $table->string('mother_profession')->nullable();
            $table->string('transportation_mode')->nullable();
            $table->string('dormitory')->nullable();
            $table->string('scholarship_details')->nullable();
            $table->string('hobbies')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

// php artisan tinker
//  \App\Models\Student::create([  |or| \App\Models\Student::where('id', 1)->update([
//     'class_id' => 1,
//     'name' => 'Rahim Islam', 
//     'email' => 'rahim_islam@example.com', 
//     'student_phone' => '01711111111',
//     'address' => 'Natore, Bangladesh', 
//     'date_of_birth' => '2010-05-12',
//     'gender' => 'male',
//     'guardian_name' => 'Karim Uddin',
//     'guardian_phone' => '01722222299', 
//     'guardian_email' => 'karim@example.com',
//     'guardian_relationship' => 'Father',
//     'enrollment_date' => '2025-01-10',
//     'status' => 'active',
//     'photo_path' => 'photos/rahim.jpg',
//     'roll_number' => 'R-001',
//     'admission_number' => 'ADM-2024-001', 
//     'blood_group' => 'A+',
//     'national_id' => '1234567890',
//     'religion' => 'Islam',
//     'mother_tongue' => 'Bangla',
//     'previous_school' => 'ABC School',
//     'medical_conditions' => 'None',
//     'allergies' => 'None',
//     'emergency_contact_name' => 'Hasan Ali',
//     'emergency_contact_phone' => '01733333333',
//     'father_profession' => 'Businessman',
//     'mother_profession' => 'Teacher',
//     'transportation_mode' => 'Train', 
//     'dormitory' => 'None',
//     'scholarship_details' => 'None',
//     'hobbies' => 'Reading, Cric', 
//     'notes' => 'Rahim is a hardworking student and always participates in school events also GK.', 
// ]);
