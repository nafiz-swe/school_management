<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        return response()->json(Subject::with('classRoom')->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'class_room_id' => 'required|integer'
        ]);
        $subject = Subject::create($data);
        return response()->json(['message' => 'Subject created', 'data' => $subject], 201);
    }

    public function show(Subject $subject)
    {
        return response()->json($subject->load('classRoom'), 200);
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->update($request->all());
        return response()->json(['message' => 'Subject updated', 'data' => $subject], 200);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return response()->json(['message' => 'Subject deleted'], 200);
    }
}
