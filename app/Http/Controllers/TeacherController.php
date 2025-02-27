<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        return response()->json(Teacher::all(), 200);
    }

    public function show($id)
    {
        $teacher = Teacher::find($id);
        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }
        return response()->json($teacher, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:teachers,email',
            'password' => 'required|min:6',
            'fname' => 'required|string|max:45',
            'lname' => 'required|string|max:45',
            'dob' => 'required|date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $teacher = Teacher::create($validatedData);
        return response()->json($teacher, 201);
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        $validatedData = $request->validate([
            'email' => 'email|unique:teachers,email,' . $id,
            'password' => 'nullable|min:6',
            'fname' => 'string|max:45',
            'lname' => 'string|max:45',
            'dob' => 'date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $teacher->update($validatedData);
        return response()->json($teacher, 200);
    }

    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        $teacher->delete();
        return response()->json(['message' => 'Teacher deleted'], 200);
    }
}
