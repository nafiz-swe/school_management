<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\StudentResource;

class StudentApiController extends Controller
{
    /*
        🔵 RESTful Controller:
        index()   = GET /api/students
        store()   = POST /api/students
        show()    = GET /api/students/{id}
        update()  = PUT/PATCH /api/students/{id}
        destroy() = DELETE /api/students/{id}
        
        🔹 Resource + Pagination + Validation + Photo Upload + JSON Response
    */

    // 1️⃣ List all students (with pagination + Resource formatting)
    public function index()
    {
        $students = Student::with('classRoom')->paginate(10); // API pagination

        return StudentResource::collection($students)
            ->additional([
                'status'  => true,
                'message' => 'Students fetched successfully (REST)',
            ]);
    }

    // 2️⃣ Store new student
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class_id' => 'required|exists:class_rooms,id',
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:students,email',
            'photo_path'=> 'nullable|file|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation error',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        // Photo upload handling
        if ($request->hasFile('photo_path')) {
            $data['photo_path'] = $request->file('photo_path')->store('students', 'public');
        }

        $student = Student::create($data);

        return (new StudentResource($student))
            ->additional([
                'status'  => true,
                'message' => 'Student created successfully (REST)',
            ])->response()->setStatusCode(201);
    }

    // 3️⃣ Show single student
    public function show($id)
    {
        $student = Student::with('classRoom')->find($id);

        if (!$student) {
            return response()->json([
                'status'  => false,
                'message' => 'Student not found',
            ], 404);
        }

        return (new StudentResource($student))
            ->additional([
                'status'  => true,
                'message' => 'Student fetched successfully (REST)',
            ]);
    }

    // 4️⃣ Update student
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'status'  => false,
                'message' => 'Student not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'email'     => 'sometimes|email|unique:students,email,' . $id,
            'name'      => 'sometimes|string|max:255',
            'photo_path'=> 'sometimes|nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation error',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        // Photo update handling
        if ($request->hasFile('photo_path')) {
            $data['photo_path'] = $request->file('photo_path')->store('students', 'public');
        }

        $student->update($data);

        return (new StudentResource($student))
            ->additional([
                'status'  => true,
                'message' => 'Student updated successfully (REST)',
            ]);
    }

    // 5️⃣ Delete student
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'status'  => false,
                'message' => 'Student not found',
            ], 404);
        }

        $student->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Student deleted successfully (REST)',
        ], 200);
    }
}
