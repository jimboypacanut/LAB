<?php

namespace App\Http\Controllers;

use App\Models\ExamTypes;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ExamTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(ExamTypes::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'desc' => 'nullable|string|max:45',
        ]);

        $examType = ExamTypes::create($request->all());

        return response()->json(['message' => 'Exam Type created successfully', 'exam_type' => $examType], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $examType = ExamTypes::find($id);
        if (!$examType) {
            return response()->json(['message' => 'Exam Type not found'], 404);
        }
        return response()->json($examType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $examType = ExamTypes::find($id);
        if (!$examType) {
            return response()->json(['message' => 'Exam Type not found'], 404);
        }

        $request->validate([
            'name' => 'string|max:45',
            'desc' => 'nullable|string|max:45',
        ]);

        $examType->update($request->all());

        return response()->json(['message' => 'Exam Type updated successfully', 'exam_type' => $examType]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $examType = ExamTypes::find($id);
        if (!$examType) {
            return response()->json(['message' => 'Exam Type not found'], 404);
        }

        $examType->delete();
        return response()->json(['message' => 'Exam Type deleted successfully']);
    }
}
