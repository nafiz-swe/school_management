<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /*
        🔹 এই Controller টি Web এর জন্য।  
        🔹 Student এর CRUD operations handle করে।  
        🔹 Student model কে ব্যবহার করে database access করে।  
        🔹 Request file (StoreStudentRequest, UpdateStudentRequest) দিয়ে validation professionalভাবে handle করা হয়েছে।  
        🔹 Photo upload/delete handling ও included।  
        🔹 Exception handling দিয়ে যদি কোনো error হয় তা back() সহ message দেখায়।  
        🔹 Index, create, edit view return করে Blade/Vue/React templates handle করে।  
    */

    // List all students with pagination
    public function index()
    {
        $students = Student::with('classRoom')->paginate(10); // classRoom relation load
        return view('students.index', compact('students')); // Blade view return
    }

    // Show create form
    public function create()
    {
        $classRooms = ClassRoom::all(); // Dropdown জন্য সব classRoom
        return view('students.create', compact('classRooms'));
    }

    // Store new student
    public function store(StoreStudentRequest $request)
    {
        /*
            🔹 StoreStudentRequest এ সব validation handle হয়
            🔹 try-catch দিয়ে professional error handling
            🔹 Photo upload handled
            🔹 Success message back() return
        */
        try {
            $data = $request->validated();

            // Upload photo
            if ($request->hasFile('photo_path')) {
                $data['photo_path'] = $request->file('photo_path')->store('students', 'public');
            }

            Student::create($data);

            return back()->with('success', 'Student created successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    // Show edit form
    public function edit($id)
    {
        $student = Student::findOrFail($id); // ID থেকে student load
        $classRooms = ClassRoom::all();

        return view('students.edit', compact('student', 'classRooms'));
    }

    // Update student
    public function update(UpdateStudentRequest $request, $id)
    {
        /*
            🔹 UpdateStudentRequest এ validation handle
            🔹 try-catch দিয়ে professional error handling
            🔹 Photo replace handled
            🔹 Success/error message back() return
        */
        try {
            $student = Student::findOrFail($id);
            $data = $request->validated();

            // Replace photo
            if ($request->hasFile('photo_path')) {
                if ($student->photo_path && Storage::disk('public')->exists($student->photo_path)) {
                    Storage::disk('public')->delete($student->photo_path);
                }

                $data['photo_path'] = $request->file('photo_path')->store('students', 'public');
            }

            $student->update($data);

            return back()->with('success', 'Student updated successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    // Delete student
    public function destroy($id)
    {
        /*
            🔹 ID দিয়ে student load
            🔹 Photo delete handled
            🔹 Student delete
            🔹 try-catch দিয়ে professional error handling
            🔹 Success/error message back() return
        */
        try {
            $student = Student::findOrFail($id);

            // Delete photo
            if ($student->photo_path && Storage::disk('public')->exists($student->photo_path)) {
                Storage::disk('public')->delete($student->photo_path);
            }

            $student->delete();

            return back()->with('success', 'Student deleted successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }
}
