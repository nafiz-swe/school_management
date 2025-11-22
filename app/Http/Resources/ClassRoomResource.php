<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;



/*
|--------------------------------------------------------------------------
| ClassRoom API Resource (Http/Resources/ClassRoomResource.php)
|--------------------------------------------------------------------------
|
| 🔹 এই Resource ফাইলটি Database থেকে fetch করা ডাটাকে JSON format এ convert করে। 
| 🔹 এটি নির্ধারণ করে কোন fields API response এ যাবে। উদাহরণস্বরূপ:
|     - id, class_level, room_number, floor_number, group_name, section
| 🔹 Resource ব্যবহার করার সুবিধা:
|     1. Data presentation centralized হয় → Controller এ duplicate JSON formatting দরকার পড়ে না।
|     2. Future-proof → যদি নতুন field add বা remove করতে হয়, শুধু Resource এ change করতে হবে।
|     3. Consistent API structure → সকল endpoint এ একই ধরনের JSON response পাওয়া যায়।
|
| প্রয়োজনীয় কারণ:
| - Controller শুধু logic handle করে, Resource handle করে data presentation।
| - Mobile/Frontend সব জায়গায় uniform JSON structure provide করে।
|
*/

class ClassRoomResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'class_level'  => $this->class_level,
            'room_number'  => $this->room_number,
            'floor_number' => $this->floor_number,
            'group_name'   => $this->group_name,
            'section'      => $this->section,
        ];
    }
}
