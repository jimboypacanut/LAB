<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;


class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Students::with('parent')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:45|unique:students,email',
            'password' => 'required|string|min:6',
            'fname' => 'required|string|max:45',
            'lname' => 'required|string|max:45',
            'dob' => 'nullable|date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
            'parent_id' => 'nullable|exists:parents,parent_id',
            'date_of_join' => 'nullable|date',
            'status' => 'boolean',
        ]);

        $student = Students::create([
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'parent_id' => $request->parent_id,
            'date_of_join' => $request->date_of_join,
            'status' => $request->status ?? true,
            'last_login_ip' => $request->ip(),
        ]);

        return response()->json(['message' => 'Student created successfully', 'student' => $student], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Students::with('parent')->find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Students::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $request->validate([
            'email' => 'string|max:45|unique:students,email,' . $id . ',student_id',
            'password' => 'nullable|string|min:6',
            'fname' => 'string|max:45',
            'lname' => 'string|max:45',
            'dob' => 'nullable|date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
            'parent_id' => 'nullable|exists:parents,parent_id',
            'date_of_join' => 'nullable|date',
            'status' => 'boolean',
        ]);

        $student->update([
            'email' => $request->email ?? $student->email,
            'password' => $request->password ? Hash::make($request->password) : $student->password,
            'fname' => $request->fname ?? $student->fname,
            'lname' => $request->lname ?? $student->lname,
            'dob' => $request->dob ?? $student->dob,
            'phone' => $request->phone ?? $student->phone,
            'mobile' => $request->mobile ?? $student->mobile,
            'parent_id' => $request->parent_id ?? $student->parent_id,
            'date_of_join' => $request->date_of_join ?? $student->date_of_join,
            'status' => $request->status ?? $student->status,
            'last_login_ip' => $request->ip(),
        ]);

        return response()->json(['message' => 'Student updated successfully', 'student' => $student]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Students::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
}
