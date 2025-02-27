<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    // Get all students
    public function index()
    {
        return response()->json(Student::all(), 200);
    }

    // Get a single student by ID
    public function show($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        return response()->json($student, 200);
    }

    // Create a new student
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6',
            'fname' => 'required|string|max:45',
            'lname' => 'required|string|max:45',
            'dob' => 'required|date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $student = Student::create($validatedData);
        return response()->json($student, 201);
    }

    // Update student info
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $validatedData = $request->validate([
            'email' => 'email|unique:students,email,' . $id,
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

        $student->update($validatedData);
        return response()->json($student, 200);
    }

    // Delete a student
    public function destroy($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();
        return response()->json(['message' => 'Student deleted'], 200);
    }
}
