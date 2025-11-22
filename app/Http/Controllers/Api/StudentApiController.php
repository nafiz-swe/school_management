<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentApiController extends Controller
{
    /*
        🔹 এই Controller টি Mobile App/API/Web API এর জন্য।  
        🔹 Student এর CRUD operations API endpoint হিসেবে provide করে।  
        🔹 Student model কে ব্যবহার করে database access করে।  
        🔹 Validator দিয়ে professional validation handle করা হয়েছে।  
        🔹 Photo upload/update handled.  
        🔹 Proper JSON response return করে status, message এবং data সহ।  
        🔹 API তে Exception/Validation error handle করা হয়েছে।  
    */

    // List all students with pagination
    // API GET /api/students
    public function index()
    {
        // classRoom relation সহ load করা হয়েছে
        $students = Student::with('classRoom')->paginate(10);

        return response()->json([
            'status'  => true,
            'message' => 'Students fetched successfully',
            'data'    => $students,
        ], 200);
    }

    // Store new student
    // API POST /api/students
    public function store(Request $request)
    {
        /*
            🔹 Full Form Validation (Web এর মতো)
            🔹 Validation fail হলে proper error JSON response
            🔹 Photo upload handled
            🔹 Data saved to database
            🔹 JSON success response return
        */
        $validator = Validator::make($request->all(), [
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

        return response()->json([
            'status'  => true,
            'message' => 'Student created successfully',
            'data'    => $student,
        ], 201);
    }

    // Show single student
    // API GET /api/students/{id}
    public function show($id)
    {
        $student = Student::with('classRoom')->find($id);

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Student not found'
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Student fetched successfully',
            'data'    => $student,
        ], 200);
    }

    // Update student
    // API PUT/PATCH /api/students/{id}
    public function update(Request $request, $id)
    {
        /*
            🔹 Update Validation Web Controller এর মতো
            🔹 Photo update handled
            🔹 JSON response return
        */
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Student not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'class_id' => 'sometimes|required|exists:class_rooms,id',
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:students,email,' . $student->id,
            'student_phone' => 'sometimes|nullable|string|max:20',
            'address' => 'sometimes|nullable|string',
            'date_of_birth' => 'sometimes|nullable|date',
            'gender' => 'sometimes|nullable|in:male,female,other',
            'guardian_name' => 'sometimes|nullable|string|max:255',
            'guardian_phone' => 'sometimes|nullable|string|max:20',
            'guardian_email' => 'sometimes|nullable|email',
            'guardian_relationship' => 'sometimes|nullable|string|max:255',
            'enrollment_date' => 'sometimes|nullable|date',
            'status' => 'sometimes|nullable|string',
            'photo_path' => 'sometimes|nullable|file|image|max:2048',
            'roll_number' => 'sometimes|nullable|string|unique:students,roll_number,' . $student->id,
            'admission_number' => 'sometimes|nullable|string|unique:students,admission_number,' . $student->id,
            'blood_group' => 'sometimes|nullable|string|max:10',
            'national_id' => 'sometimes|nullable|string|unique:students,national_id,' . $student->id,
            'religion' => 'sometimes|nullable|string|max:50',
            'mother_tongue' => 'sometimes|nullable|string|max:50',
            'previous_school' => 'sometimes|nullable|string|max:255',
            'medical_conditions' => 'sometimes|nullable|string|max:255',
            'allergies' => 'sometimes|nullable|string|max:255',
            'emergency_contact_name' => 'sometimes|nullable|string|max:255',
            'emergency_contact_phone' => 'sometimes|nullable|string|max:20',
            'father_profession' => 'sometimes|nullable|string|max:255',
            'mother_profession' => 'sometimes|nullable|string|max:255',
            'transportation_mode' => 'sometimes|nullable|string|max:50',
            'dormitory' => 'sometimes|nullable|string|max:50',
            'scholarship_details' => 'sometimes|nullable|string|max:255',
            'hobbies' => 'sometimes|nullable|string|max:255',
            'notes' => 'sometimes|nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        // Photo update
        if ($request->hasFile('photo_path')) {
            $data['photo_path'] = $request->file('photo_path')->store('students', 'public');
        }

        $student->update($data);

        return response()->json([
            'status'  => true,
            'message' => 'Student updated successfully',
            'data'    => $student,
        ], 200);
    }

    // Delete student
    // API DELETE /api/students/{id}
    public function destroy($id)
    {
        /*
            🔹 Student delete
            🔹 Proper JSON response
        */
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Student not found'
            ], 404);
        }

        $student->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Student deleted successfully',
        ], 200);
    }
}
