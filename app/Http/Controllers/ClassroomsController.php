<?php

namespace App\Http\Controllers;

use App\Models\Classrooms;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ClassroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Classrooms::with(['grade', 'teacher'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|min:1900|max:2100',
            'grade_id' => 'required|exists:grades,grade_id',
            'section' => 'required|string|size:2',
            'status' => 'boolean',
            'remarks' => 'nullable|string|max:45',
            'teacher_id' => 'nullable|exists:teachers,teacher_id',
        ]);

        $classroom = Classrooms::create($request->all());

        return response()->json(['message' => 'Classroom created successfully', 'classroom' => $classroom], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $classroom = Classrooms::with(['grade', 'teacher'])->find($id);
        if (!$classroom) {
            return response()->json(['message' => 'Classroom not found'], 404);
        }
        return response()->json($classroom);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $classroom = Classrooms::find($id);
        if (!$classroom) {
            return response()->json(['message' => 'Classroom not found'], 404);
        }

        $request->validate([
            'year' => 'integer|min:1900|max:2100',
            'grade_id' => 'exists:grades,grade_id',
            'section' => 'string|size:2',
            'status' => 'boolean',
            'remarks' => 'nullable|string|max:45',
            'teacher_id' => 'nullable|exists:teachers,teacher_id',
        ]);

        $classroom->update($request->all());

        return response()->json(['message' => 'Classroom updated successfully', 'classroom' => $classroom]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $classroom = Classrooms::find($id);
        if (!$classroom) {
            return response()->json(['message' => 'Classroom not found'], 404);
        }

        $classroom->delete();
        return response()->json(['message' => 'Classroom deleted successfully']);
    }
}
