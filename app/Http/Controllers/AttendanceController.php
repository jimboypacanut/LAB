<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Student;

class AttendanceController extends Controller
{
    /**
     * Display a listing of attendance records.
     */
    public function index()
    {
        return response()->json(Attendance::with('student')->get(), 200);
    }

    /**
     * Store a newly created attendance record.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'student_id' => 'required|exists:student,student_id',
            'status' => 'required|boolean',
            'remark' => 'nullable|string',
        ]);

        $attendance = Attendance::create($validatedData);
        return response()->json($attendance, 201);
    }

    /**
     * Display the specified attendance record.
     */
    public function show($id)
    {
        $attendance = Attendance::with('student')->find($id);
        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }
        return response()->json($attendance, 200);
    }

    /**
     * Update the specified attendance record.
     */
    public function update(Request $request, $id)
    {
        $attendance = Attendance::find($id);
        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }

        $validatedData = $request->validate([
            'date' => 'date',
            'student_id' => 'exists:student,student_id',
            'status' => 'boolean',
            'remark' => 'nullable|string',
        ]);

        $attendance->update($validatedData);
        return response()->json($attendance, 200);
    }

    /**
     * Remove the specified attendance record.
     */
    public function destroy($id)
    {
        $attendance = Attendance::find($id);
        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }

        $attendance->delete();
        return response()->json(['message' => 'Attendance record deleted'], 200);
    }
}
