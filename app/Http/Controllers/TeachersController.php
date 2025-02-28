<?php

namespace App\Http\Controllers;

use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(teachers::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:45|unique:teachers,email',
            'password' => 'required|string|min:6',
            'fname' => 'required|string|max:45',
            'lname' => 'required|string|max:45',
            'dob' => 'nullable|date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
            'status' => 'boolean',
        ]);

        $teacher = Teachers::create([
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'status' => $request->status ?? true,
            'last_login_ip' => $request->ip(),
        ]);

        return response()->json(['message' => 'Teacher created successfully', 'teacher' => $teacher], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $teacher = Teachers::find($id);
        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }
        return response()->json($teacher);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $teacher = Teachers::find($id);
        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        $request->validate([
            'email' => 'string|max:45|unique:teachers,email,' . $id . ',teacher_id',
            'password' => 'nullable|string|min:6',
            'fname' => 'string|max:45',
            'lname' => 'string|max:45',
            'dob' => 'nullable|date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
            'status' => 'boolean',
        ]);

        $teacher->update([
            'email' => $request->email ?? $teacher->email,
            'password' => $request->password ? Hash::make($request->password) : $teacher->password,
            'fname' => $request->fname ?? $teacher->fname,
            'lname' => $request->lname ?? $teacher->lname,
            'dob' => $request->dob ?? $teacher->dob,
            'phone' => $request->phone ?? $teacher->phone,
            'mobile' => $request->mobile ?? $teacher->mobile,
            'status' => $request->status ?? $teacher->status,
            'last_login_ip' => $request->ip(),
        ]);

        return response()->json(['message' => 'Teacher updated successfully', 'teacher' => $teacher]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teacher = Teachers::find($id);
        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        $teacher->delete();
        return response()->json(['message' => 'Teacher deleted successfully']);
    }
}
