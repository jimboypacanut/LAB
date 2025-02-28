<?php

namespace App\Http\Controllers;

use App\Models\Exams;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Exams::with('examType')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'exam_type_id' => 'required|exists:exam_types,exam_type_id',
            'name' => 'required|string|max:45',
            'start_date' => 'required|date',
        ]);

        $exam = Exams::create($request->all());

        return response()->json(['message' => 'Exam created successfully', 'exam' => $exam], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $exam = Exams::with('examType')->find($id);
        if (!$exam) {
            return response()->json(['message' => 'Exam not found'], 404);
        }
        return response()->json($exam);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $exam = Exams::find($id);
        if (!$exam) {
            return response()->json(['message' => 'Exam not found'], 404);
        }

        $request->validate([
            'exam_type_id' => 'exists:exam_types,exam_type_id',
            'name' => 'string|max:45',
            'start_date' => 'date',
        ]);

        $exam->update($request->all());

        return response()->json(['message' => 'Exam updated successfully', 'exam' => $exam]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $exam = Exams::find($id);
        if (!$exam) {
            return response()->json(['message' => 'Exam not found'], 404);
        }

        $exam->delete();
        return response()->json(['message' => 'Exam deleted successfully']);
    }
}
