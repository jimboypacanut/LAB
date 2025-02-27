<?php

namespace App\Http\Controllers;

use App\Models\ClassroomStudent;
use Illuminate\Validation\ValidationException;
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
        try {
            $validatedData = $request->validate([
                'classroom_id' => 'required|integer',
                'student_id' => 'required|integer',
            ]);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        }

        $record = ClassroomStudent::create($validatedData);
        return response()->json($record, 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'classroom_id' => 'integer',
                'student_id' => 'integer',
            ]);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        }

        $record = ClassroomStudent::find($id);
        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

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
