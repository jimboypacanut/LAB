<?php

namespace App\Http\Controllers;

use App\Models\ExamResult;
use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    /**
     * Display a listing of the exam results.
     */
    public function index()
    {
        return response()->json(ExamResult::all(), 200);
    }

    /**
     * Store a newly created exam result.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'marks' => 'required|integer|max:100',
        ]);

        $examResult = ExamResult::create($validatedData);
        return response()->json($examResult, 201);
    }

    /**
     * Display the specified exam result.
     */
    public function show($id)
    {
        $examResult = ExamResult::find($id);
        if (!$examResult) {
            return response()->json(['message' => 'Exam Result not found'], 404);
        }
        return response()->json($examResult, 200);
    }

    /**
     * Update the specified exam result.
     */
    public function update(Request $request, $id)
    {
        $examResult = ExamResult::find($id);
        if (!$examResult) {
            return response()->json(['message' => 'Exam Result not found'], 404);
        }

        $validatedData = $request->validate([
            'exam_id' => 'exists:exams,id',
            'student_id' => 'exists:students,id',
            'course_id' => 'exists:courses,id',
            'marks' => 'integer|max:100',
        ]);

        $examResult->update($validatedData);
        return response()->json($examResult, 200);
    }

    /**
     * Remove the specified exam result from storage.
     */
    public function destroy($id)
    {
        $examResult = ExamResult::find($id);
        if (!$examResult) {
            return response()->json(['message' => 'Exam Result not found'], 404);
        }

        $examResult->delete();
        return response()->json(['message' => 'Exam Result deleted'], 200);
    }
}
