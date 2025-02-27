<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of classrooms.
     */
    public function index()
    {
        return response()->json(Classroom::with(['grade', 'teacher'])->get(), 200);
    }

    /**
     * Store a newly created classroom.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'classroom_id' => 'required|integer|unique:classroom,classroom_id',
            'year' => 'required|digits:4|integer|min:2000',
            'grade_id' => 'required|exists:grades,id',
            'section' => 'required|string|size:2',
            'status' => 'required|boolean',
            'remarks' => 'nullable|string|max:45',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $classroom = Classroom::create($validatedData);
        return response()->json($classroom, 201);
    }

    /**
     * Display the specified classroom.
     */
    public function show($id)
    {
        $classroom = Classroom::with(['grade', 'teacher'])->find($id);
        if (!$classroom) {
            return response()->json(['message' => 'Classroom not found'], 404);
        }
        return response()->json($classroom, 200);
    }

    /**
     * Update the specified classroom.
     */
    public function update(Request $request, $id)
    {
        $classroom = Classroom::find($id);
        if (!$classroom) {
            return response()->json(['message' => 'Classroom not found'], 404);
        }

        $validatedData = $request->validate([
            'year' => 'digits:4|integer|min:2000',
            'grade_id' => 'exists:grades,id',
            'section' => 'string|size:2',
            'status' => 'boolean',
            'remarks' => 'nullable|string|max:45',
            'teacher_id' => 'exists:teachers,id',
        ]);

        $classroom->update($validatedData);
        return response()->json($classroom, 200);
    }

    /**
     * Remove the specified classroom from storage.
     */
    public function destroy($id)
    {
        $classroom = Classroom::find($id);
        if (!$classroom) {
            return response()->json(['message' => 'Classroom not found'], 404);
        }

        $classroom->delete();
        return response()->json(['message' => 'Classroom deleted'], 200);
    }
}
