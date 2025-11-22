<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;



/*
|--------------------------------------------------------------------------
| API Resource Files
|--------------------------------------------------------------------------
|
| 🔹 Resource ফাইলের কাজ: Database থেকে fetch করা data কে JSON format এ convert করা। 
| 🔹 Resource define করে কোন fields API response এ যাবে। উদাহরণস্বরূপ:
|     - ClassRoomResource → id, class_level, room_number, floor_number, group_name, section
|     - StudentResource → id, class_id, name, email, student_phone, photo_path, roll_number, admission_number, ইত্যাদি
|
| 🔹 কেন প্রয়োজন:
|     1. Data presentation centralized হয় → Controller এ duplicate JSON formatting দরকার হয় না।
|     2. Consistent API response → সকল endpoint এ একই ধরনের JSON structure পাওয়া যায়।
|     3. Maintenance সহজ → যদি field add/remove করতে হয়, শুধু Resource ফাইল update করলেই হয়।
|     4. Mobile, frontend, React/Vue/Flutter সব জায়গায় uniform response পাওয়া যায়।
|
| 🔹 সংক্ষেপে:
|     - Controller handle করে logic, validation, CRUD
|     - Resource handle করে data presentation (কোন data কোথায় যাবে এবং কেমন format এ যাবে)
|
*/


class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                      => $this->id,
            'class_id'                => $this->class_id,
            'class_room'              => new ClassRoomResource($this->whenLoaded('classRoom')),

            'name'                    => $this->name,
            'email'                   => $this->email,
            'student_phone'           => $this->student_phone,
            'address'                 => $this->address,
            'date_of_birth'           => $this->date_of_birth,
            'gender'                  => $this->gender,

            'guardian_name'           => $this->guardian_name,
            'guardian_phone'          => $this->guardian_phone,
            'guardian_email'          => $this->guardian_email,
            'guardian_relationship'   => $this->guardian_relationship,

            'enrollment_date'         => $this->enrollment_date,
            'status'                  => $this->status,
            'photo_url'               => $this->photo_path 
                                           ? asset('storage/' . $this->photo_path) 
                                           : null,

            'roll_number'             => $this->roll_number,
            'admission_number'        => $this->admission_number,

            'blood_group'             => $this->blood_group,
            'national_id'             => $this->national_id,
            'religion'                => $this->religion,
            'mother_tongue'           => $this->mother_tongue,

            'previous_school'         => $this->previous_school,
            'medical_conditions'      => $this->medical_conditions,
            'allergies'               => $this->allergies,

            'emergency_contact_name'  => $this->emergency_contact_name,
            'emergency_contact_phone' => $this->emergency_contact_phone,

            'father_profession'       => $this->father_profession,
            'mother_profession'       => $this->mother_profession,

            'transportation_mode'     => $this->transportation_mode,
            'dormitory'               => $this->dormitory,
            'scholarship_details'     => $this->scholarship_details,

            'hobbies'                 => $this->hobbies,
            'notes'                   => $this->notes,

            // timestamps
            'created_at'              => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'              => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
