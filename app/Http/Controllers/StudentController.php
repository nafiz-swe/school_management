<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // List all students
    public function index()
    {
        $students = Student::with('classRoom')->get(); // classRoom relation সহ
        return view('students.index', compact('students'));
    }

    // Show create form
    public function create()
    {
        $classRooms = ClassRoom::all(); // Dropdown জন্য
        return view('students.create', compact('classRooms'));
    }

    // Store new student
    public function store(Request $request)
    {
        $data = $request->validate([
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

        // Photo upload
        if ($request->hasFile('photo_path')) {
            $data['photo_path'] = $request->file('photo_path')->store('students', 'public');
        }

        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $classRooms = ClassRoom::all();
        return view('students.edit', compact('student', 'classRooms'));
    }

    // Update student
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $data = $request->validate([
            'class_id' => 'required|exists:class_rooms,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
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
            'roll_number' => 'nullable|string|unique:students,roll_number,' . $student->id,
            'admission_number' => 'nullable|string|unique:students,admission_number,' . $student->id,
            'blood_group' => 'nullable|string|max:10',
            'national_id' => 'nullable|string|unique:students,national_id,' . $student->id,
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

        // Photo upload
        if ($request->hasFile('photo_path')) {
            $data['photo_path'] = $request->file('photo_path')->store('students', 'public');
        }

        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    // Delete student
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }

    // Show single student (optional)
    public function show($id)
    {
        $student = Student::with('classRoom')->findOrFail($id);
        return view('students.show', compact('student'));
    }
}
