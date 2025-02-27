<?php

namespace App\Http\Controllers;

use App\Models\Parentmodel; // FIXED: Ensuring the correct model name
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ParentmodelController extends Controller
{
    // Get all parents
    public function index()
    {
        return response()->json(Parentmodel::all(), 200);
    }

    // Get a single parent by ID
    public function show($id)
    {
        $parent = Parentmodel::find($id);
        if (!$parent) {
            return response()->json(['message' => 'Parent not found'], 404);
        }
        return response()->json($parent, 200);
    }

    // Create a new parent
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:parent,email', // FIXED: Correct table name
            'password' => 'required|min:6',
            'fname' => 'required|string|max:45',
            'lname' => 'required|string|max:45',
            'dob' => 'required|date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $parent = Parentmodel::create($validatedData);
        return response()->json($parent, 201);
    }

    // Update a parent's information
    public function update(Request $request, $id)
    {
        $parent = Parentmodel::find($id);
        if (!$parent) {
            return response()->json(['message' => 'Parent not found'], 404);
        }

        $validatedData = $request->validate([
            'email' => 'email|unique:parent,email,' . $id . ',parent_id', // FIXED: Correct table name
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

        $parent->update($validatedData);
        return response()->json($parent, 200);
    }

    // Delete a parent
    public function destroy($id)
    {
        $parent = Parentmodel::find($id);
        if (!$parent) {
            return response()->json(['message' => 'Parent not found'], 404);
        }

        $parent->delete();
        return response()->json(['message' => 'Parent deleted'], 200);
    }
}
