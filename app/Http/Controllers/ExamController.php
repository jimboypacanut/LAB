<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the exams.
     */
    public function index()
    {
        return response()->json(Exam::with('examType')->get(), 200);
    }

    /**
     * Store a newly created exam.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'exam_type_id' => 'required|exists:exam_types,exam_type_id',
            'name' => 'required|string|max:45',
            'start_date' => 'required|date',
        ]);

        $exam = Exam::create($validatedData);
        return response()->json($exam, 201);
    }

    /**
     * Display the specified exam.
     */
    public function show($id)
    {
        $exam = Exam::with('examType')->find($id);
        if (!$exam) {
            return response()->json(['message' => 'Exam not found'], 404);
        }
        return response()->json($exam, 200);
    }

    /**
     * Update the specified exam.
     */
    public function update(Request $request, $id)
    {
        $exam = Exam::find($id);
        if (!$exam) {
            return response()->json(['message' => 'Exam not found'], 404);
        }

        $validatedData = $request->validate([
            'exam_type_id' => 'exists:exam_types,exam_type_id',
            'name' => 'string|max:45',
            'start_date' => 'date',
        ]);

        $exam->update($validatedData);
        return response()->json($exam, 200);
    }

    /**
     * Remove the specified exam from storage.
     */
    public function destroy($id)
    {
        $exam = Exam::find($id);
        if (!$exam) {
            return response()->json(['message' => 'Exam not found'], 404);
        }

        $exam->delete();
        return response()->json(['message' => 'Exam deleted'], 200);
    }
}
