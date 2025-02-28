<?php

namespace App\Http\Controllers;

use App\Models\ExamResults;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ExamResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(ExamResults::with(['exam', 'student', 'course'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,exam_id',
            'student_id' => 'required|exists:students,student_id',
            'course_id' => 'required|exists:courses,course_id',
            'marks' => 'required|string|max:45',
        ]);

        $examResult = ExamResults::create($request->all());

        return response()->json(['message' => 'Exam Result added successfully', 'exam_result' => $examResult], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($exam_id, $student_id, $course_id)
    {
        $examResult = ExamResults::where([
            ['exam_id', $exam_id],
            ['student_id', $student_id],
            ['course_id', $course_id]
        ])->first();

        if (!$examResult) {
            return response()->json(['message' => 'Exam Result not found'], 404);
        }

        return response()->json($examResult);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $exam_id, $student_id, $course_id)
    {
        $examResult = ExamResults::where([
            ['exam_id', $exam_id],
            ['student_id', $student_id],
            ['course_id', $course_id]
        ])->first();

        if (!$examResult) {
            return response()->json(['message' => 'Exam Result not found'], 404);
        }

        $request->validate([
            'marks' => 'string|max:45',
        ]);

        $examResult->update($request->only('marks'));

        return response()->json(['message' => 'Exam Result updated successfully', 'exam_result' => $examResult]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($exam_id, $student_id, $course_id)
    {
        $examResult = ExamResults::where([
            ['exam_id', $exam_id],
            ['student_id', $student_id],
            ['course_id', $course_id]
        ])->first();

        if (!$examResult) {
            return response()->json(['message' => 'Exam Result not found'], 404);
        }

        $examResult->delete();
        return response()->json(['message' => 'Exam Result deleted successfully']);
    }
}
