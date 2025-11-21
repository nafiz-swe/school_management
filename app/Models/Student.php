<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

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

    // Correct relationship with class_rooms table
    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }
}
