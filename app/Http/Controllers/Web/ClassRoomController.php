<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    public function index()
    {
        $classes = ClassRoom::all();
        return view('classes.class', compact('classes'));
    }

    public function create()
    {
        return view('classes.class'); // same blade, form will detect create/edit
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'class_level' => 'required|string',
            'room_number' => 'required|string',
            'floor_number' => 'nullable|string',
            'group_name' => 'required|string',
            'section' => 'required|string',
        ]);

        ClassRoom::create($data);
        return redirect()->route('class_rooms.index')->with('success', 'Class created');
    }

    public function edit(ClassRoom $classRoom)
    {
        $classes = ClassRoom::all();
        return view('classes.class', compact('classes', 'classRoom'));
    }

    public function update(Request $request, ClassRoom $classRoom)
    {
        $data = $request->validate([
            'class_level' => 'required|string',
            'room_number' => 'required|string',
            'floor_number' => 'nullable|string',
            'group_name' => 'required|string',
            'section' => 'required|string',
        ]);

        $classRoom->update($data);
        return redirect()->route('class_rooms.index')->with('success', 'Class updated');
    }

    public function destroy(ClassRoom $classRoom)
    {
        $classRoom->delete();
        return redirect()->route('class_rooms.index')->with('success', 'Class deleted');
    }
}
