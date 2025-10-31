<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    public function index()
    {
        return response()->json(ExamResult::with('student', 'subject')->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'marks' => 'required|integer|min:0|max:100'
        ]);

        $result = ExamResult::create($data);
        return response()->json(['message' => 'Result added', 'data' => $result], 201);
    }

    public function show(ExamResult $examResult)
    {
        return response()->json($examResult->load('student', 'subject'), 200);
    }

    public function update(Request $request, ExamResult $examResult)
    {
        $examResult->update($request->all());
        return response()->json(['message' => 'Result updated', 'data' => $examResult], 200);
    }

    public function destroy(ExamResult $examResult)
    {
        $examResult->delete();
        return response()->json(['message' => 'Result deleted'], 200);
    }
}
