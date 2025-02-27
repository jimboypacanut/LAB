<?php

namespace App\Http\Controllers;

use App\Models\ClassroomStudent;
use Illuminate\Http\Request;

class ClassroomStudentController extends Controller
{
    public function index()
    {
        return response()->json(ClassroomStudent::all(), 200);
    }

    public function show($id)
    {
        $record = ClassroomStudent::find($id);
        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        return response()->json($record, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'classroom_id' => 'required|integer',
            'student_id' => 'required|integer',
        ]);

        $record = ClassroomStudent::create($validatedData);
        return response()->json($record, 201);
    }

    public function update(Request $request, $id)
    {
        $record = ClassroomStudent::find($id);
        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $validatedData = $request->validate([
            'classroom_id' => 'integer',
            'student_id' => 'integer',
        ]);

        $record->update($validatedData);
        return response()->json($record, 200);
    }

    public function destroy($id)
    {
        $record = ClassroomStudent::find($id);
        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $record->delete();
        return response()->json(['message' => 'Record deleted'], 200);
    }
}
