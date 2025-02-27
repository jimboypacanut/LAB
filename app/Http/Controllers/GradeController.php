<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the grades.
     */
    public function index()
    {
        return response()->json(Grade::all(), 200);
    }

    /**
     * Store a newly created grade in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'grade_id' => 'required|integer|unique:grades,grade_id',
            'name' => 'required|string|max:45',
            'desc' => 'nullable|string|max:45',
        ]);

        $grade = Grade::create($validatedData);
        return response()->json($grade, 201);
    }

    /**
     * Display the specified grade.
     */
    public function show($id)
    {
        $grade = Grade::find($id);
        if (!$grade) {
            return response()->json(['message' => 'Grade not found'], 404);
        }
        return response()->json($grade, 200);
    }

    /**
     * Update the specified grade in storage.
     */
    public function update(Request $request, $id)
    {
        $grade = Grade::find($id);
        if (!$grade) {
            return response()->json(['message' => 'Grade not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'string|max:45',
            'desc' => 'nullable|string|max:45',
        ]);

        $grade->update($validatedData);
        return response()->json($grade, 200);
    }

    /**
     * Remove the specified grade from storage.
     */
    public function destroy($id)
    {
        $grade = Grade::find($id);
        if (!$grade) {
            return response()->json(['message' => 'Grade not found'], 404);
        }

        $grade->delete();
        return response()->json(['message' => 'Grade deleted'], 200);
    }
}
