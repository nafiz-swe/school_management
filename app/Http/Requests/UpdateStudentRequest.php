<?php
/*
 |--------------------------------------------------------------------------
 | UpdateStudentRequest – এই ফাইলটি কেন ব্যবহার করা হয়?
 |--------------------------------------------------------------------------
 | ▸ Update করার সময় (PUT/PATCH) store-এর মতো strict validation দরকার হয় না।
 |   যেমন: email আপডেট করলে unique হতে হবে, কিন্তু নিজের email বাদে।
 |
 | ▸ Update-এর validation store-এর থেকে আলাদা হওয়ায় আলাদা Request ক্লাস লাগে।
 |
 | ▸ এখানে rule গুলো update পরিস্থিতি অনুযায়ী সেট করা থাকে।
 |   যেমন user update করলে email rule হবে:
 |       'email' => 'nullable|email|unique:students,email,' . $this->id
 |
 | ▸ সুবিধা:
 |      ✓ Store এবং Update-এর rule mix হয় না
 |      ✓ Update লজিক আরও flexible ও clean হয়
 |      ✓ Controller ছোট ও readable থাকে
 |
 | ▸ এই ফাইল শুধুমাত্র "Update" রিকোয়েস্টের validation নিয়ন্ত্রণ করে।
 |
 */

 
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('id'); // URL থেকে ID

        return [
            'class_id' => 'required|exists:class_rooms,id',
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:students,email,$id",
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
            'roll_number' => "nullable|string|unique:students,roll_number,$id",
            'admission_number' => "nullable|string|unique:students,admission_number,$id",
            'blood_group' => 'nullable|string|max:10',
            'national_id' => "nullable|string|unique:students,national_id,$id",
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
