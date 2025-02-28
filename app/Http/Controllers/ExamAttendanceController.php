<?php

namespace App\Http\Controllers;

use App\Models\ExamAttendance;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ExamAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(ExamAttendance::with(['exam', 'student'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,exam_id',
            'student_id' => 'required|exists:students,student_id',
            'status' => 'boolean',
            'remarks' => 'nullable|string|max:100',
        ]);

        $examAttendance = ExamAttendance::create($request->all());

        return response()->json(['message' => 'Exam Attendance recorded successfully', 'exam_attendance' => $examAttendance], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $examAttendance = ExamAttendance::with(['exam', 'student'])->find($id);
        if (!$examAttendance) {
            return response()->json(['message' => 'Exam Attendance not found'], 404);
        }
        return response()->json($examAttendance);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $examAttendance = ExamAttendance::find($id);
        if (!$examAttendance) {
            return response()->json(['message' => 'Exam Attendance not found'], 404);
        }

        $request->validate([
            'status' => 'boolean',
            'remarks' => 'nullable|string|max:100',
        ]);

        $examAttendance->update($request->all());

        return response()->json(['message' => 'Exam Attendance updated successfully', 'exam_attendance' => $examAttendance]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $examAttendance = ExamAttendance::find($id);
        if (!$examAttendance) {
            return response()->json(['message' => 'Exam Attendance not found'], 404);
        }

        $examAttendance->delete();
        return response()->json(['message' => 'Exam Attendance deleted successfully']);
    }
}
