<?php
/*
 |--------------------------------------------------------------------------
 | StoreStudentRequest – এই ফাইলটি কেন ব্যবহার করা হয়?
 |--------------------------------------------------------------------------
 | ▸ যখন নতুন Student তৈরি করা হয় (store), তখন কোন কোন ডাটা অবশ্যই লাগবে,
 |   কোন ডাটা optional হবে, কোনগুলো unique হতে হবে — এগুলোর নিয়ম এখানে থাকে।
 |
 | ▸ Controller-এ validation কোড রাখলে Controller লম্বা ও অগোছালো হয়ে যায়।
 |   তাই validation-কে আলাদা Request ক্লাসে এনে Controller-কে clean রাখা হয়।
 |
 | ▸ এই ফাইল শুধু "Create / Store" করার সময়ের validation নিয়ন্ত্রণ করে।
 |
 | ▸ সুবিধা:
 |      ✓ কোড পরিষ্কার ও পেশাদার দেখায়
 |      ✓ Validation এক জায়গায় থাকে, maintain করা সহজ
 |      ✓ Controller-এর কাজ কমে যায়, শুধু লজিক থাকে
 |
 | ▸ উদাহরণ:
 |   - Store করার সময় email অবশ্যই unique হবে
 |   - অটো validation error response Laravel নিজে হ্যান্ডেল করে
 |
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow
    }

    public function rules()
    {
        return [
            'class_id' => 'required|exists:class_rooms,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'student_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_phone' => 'nullable|string|max:20',
            'guardian_email' => 'nullable|email',
            'guardian_relationship' => 'nullable|string|max:255',
            'enrollment_date' => 'nullable|date',
            'status' => 'nullable|string',
            'photo_path' => 'nullable|file|image|max:2048',
            'roll_number' => 'nullable|string|unique:students,roll_number',
            'admission_number' => 'nullable|string|unique:students,admission_number',
            'blood_group' => 'nullable|string|max:10',
            'national_id' => 'nullable|string|unique:students,national_id',
            'religion' => 'nullable|string|max:50',
            'mother_tongue' => 'nullable|string|max:50',
            'previous_school' => 'nullable|string|max:255',
            'medical_conditions' => 'nullable|string|max:255',
            'allergies' => 'nullable|string|max:255',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'father_profession' => 'nullable|string|max:255',
            'mother_profession' => 'nullable|string|max:255',
            'transportation_mode' => 'nullable|string|max:50',
            'dormitory' => 'nullable|string|max:50',
            'scholarship_details' => 'nullable|string|max:255',
            'hobbies' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ];
    }
}
