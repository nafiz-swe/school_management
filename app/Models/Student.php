<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    /*
        🔹 এই Model টি Student table এর ডাটার representation handle করে।  
        🔹 Web এর জন্য StudentController এবং API এর জন্য StudentApiController দুটোই এই একই Model ব্যবহার করে।  
        🔹 Model মূলত database access, relationships এবং mass assignment handle করে।  
        🔹 Controller শুধু request অনুযায়ী logic handle করে:  
            - Web Controller: Blade/Vue/React view return + redirect + session messages।  
            - API Controller: JSON response + HTTP status codes + API validation।  
        🔹 একটাই Model থাকা মানে database table শুধু একবার define হয়েছে, code duplication নেই।  
        🔹 Professionalভাবে comment দেওয়ার কারণে ভবিষ্যতে বুঝতে সুবিধা হয়, এবং maintenance সহজ হয়।  
    */

    protected $fillable = [
        'class_id',
        'name',
        'email',
        'student_phone',
        'address',
        'date_of_birth',
        'gender',
        'guardian_name',
        'guardian_phone',
        'guardian_email',
        'guardian_relationship',
        'enrollment_date',
        'status',
        'photo_path',
        'roll_number',
        'admission_number',
        'blood_group',
        'national_id',
        'religion',
        'mother_tongue',
        'previous_school',
        'medical_conditions',
        'allergies',
        'emergency_contact_name',
        'emergency_contact_phone',
        'father_profession',
        'mother_profession',
        'transportation_mode',
        'dormitory',
        'scholarship_details',
        'hobbies',
        'notes'
    ];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }
}
