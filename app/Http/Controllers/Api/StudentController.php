<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return Student::with('classRoom')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:students,email',
            'class_room_id' => 'required|integer'
        ]);
        return Student::create($data);
    }

    public function show(Student $student)
    {
        return $student->load('classRoom');
    }

    public function update(Request $request, Student $student)
    {
        $student->update($request->all());
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
