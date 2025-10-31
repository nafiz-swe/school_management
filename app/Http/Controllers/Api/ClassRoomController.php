<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    public function index()
    {
        return response()->json(ClassRoom::all(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string']);
        $class = ClassRoom::create($data);
        return response()->json(['message' => 'Class created', 'data' => $class], 201);
    }

    public function show(ClassRoom $classRoom)
    {
        return response()->json($classRoom->load('subjects', 'students'), 200);
    }

    public function update(Request $request, ClassRoom $classRoom)
    {
        $classRoom->update($request->only('name'));
        return response()->json(['message' => 'Class updated', 'data' => $classRoom], 200);
    }

    public function destroy(ClassRoom $classRoom)
    {
        $classRoom->delete();
        return response()->json(['message' => 'Class deleted'], 200);
    }
}
