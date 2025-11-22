<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Http\Resources\ClassRoomResource;


/*
|--------------------------------------------------------------------------
| ClassRoom API Controller (controllers/api/ClassRoomController.php)
|--------------------------------------------------------------------------
|
| 🔹 এই Controller টি পুরোপুরি API এর জন্য। 
| 🔹 এখানে সমস্ত CRUD operation handle করা হয়: 
|     - index() → সকল ক্লাস রুম দেখানো (list with students & subjects)
|     - store() → নতুন ক্লাস রুম তৈরি করা
|     - show() → single ক্লাস রুম দেখানো
|     - update() → ক্লাস রুম update করা
|     - destroy() → ক্লাস রুম delete করা
| 🔹 Controller মূলত request/response logic handle করে, validation apply করে,
|   এবং JSON response return করে। 
| 🔹 Model (ClassRoom) দিয়ে database access করে, কিন্তু Controller শুধুমাত্র
|   user input এবং API response এর জন্য logic handle করে। 
|
| প্রয়োজনীয় কারণ:
| - API endpoint কে properly organize & manage করতে হয়।
| - JSON response, validation, error handling centralized থাকে।
| - Web Controller থেকে আলাদা, কারণ এখানে Blade view দরকার হয় না।
|
*/


class ClassRoomController extends Controller
{
    // GET all classrooms (with pagination)
    public function index()
    {
        $classrooms = ClassRoom::paginate(10);
        return ClassRoomResource::collection($classrooms);
    }

    // CREATE new classroom
    public function store(Request $request)
    {
        $data = $request->validate([
            'class_level'  => 'required|string',
            'room_number'  => 'required|string',
            'floor_number' => 'nullable|string',
            'group_name'   => 'required|string',
            'section'      => 'required|string',
        ]);

        $classroom = ClassRoom::create($data);

        return new ClassRoomResource($classroom);
    }

    // SHOW single classroom
    public function show(ClassRoom $classRoom)
    {
        return new ClassRoomResource($classRoom);
    }

    // UPDATE classroom
    public function update(Request $request, ClassRoom $classRoom)
    {
        $data = $request->validate([
            'class_level'  => 'sometimes|string',
            'room_number'  => 'sometimes|string',
            'floor_number' => 'nullable|string',
            'group_name'   => 'sometimes|string',
            'section'      => 'sometimes|string',
        ]);

        $classRoom->update($data);

        return new ClassRoomResource($classRoom);
    }

    // DELETE classroom
    public function destroy(ClassRoom $classRoom)
    {
        $classRoom->delete();

        return response()->json([
            'message' => 'ClassRoom deleted successfully'
        ]);
    }
}
