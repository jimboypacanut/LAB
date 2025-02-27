<?php

namespace App\Http\Controllers;

use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    /**
     * Display a listing of the exam types.
     */
    public function index()
    {
        return response()->json(ExamType::all(), 200);
    }

    /**
     * Store a newly created exam type.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:45',
            'desc' => 'nullable|string|max:45',
        ]);

        $examType = ExamType::create($validatedData);
        return response()->json($examType, 201);
    }

    /**
     * Display the specified exam type.
     */
    public function show($id)
    {
        $examType = ExamType::find($id);
        if (!$examType) {
            return response()->json(['message' => 'Exam Type not found'], 404);
        }
        return response()->json($examType, 200);
    }

    /**
     * Update the specified exam type.
     */
    public function update(Request $request, $id)
    {
        $examType = ExamType::find($id);
        if (!$examType) {
            return response()->json(['message' => 'Exam Type not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'nullable|string|max:45',
            'desc' => 'nullable|string|max:45',
        ]);

        $examType->update($validatedData);
        return response()->json($examType, 200);
    }

    /**
     * Remove the specified exam type from storage.
     */
    public function destroy($id)
    {
        $examType = ExamType::find($id);
        if (!$examType) {
            return response()->json(['message' => 'Exam Type not found'], 404);
        }

        $examType->delete();
        return response()->json(['message' => 'Exam Type deleted'], 200);
    }
}
