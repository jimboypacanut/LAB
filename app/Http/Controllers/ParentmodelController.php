<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

class ParentmodelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(ParentModel::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:45|unique:parents,email',
            'password' => 'required|string|min:6',
            'fname' => 'required|string|max:45',
            'lname' => 'required|string|max:45',
            'dob' => 'nullable|date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
            'status' => 'boolean',
        ]);

        $parent = ParentModel::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'status' => $request->status ?? true,
            'last_login_ip' => $request->ip(),
        ]);

        return response()->json(['message' => 'Parent created successfully', 'parent' => $parent], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $parent = ParentModel::find($id);
        if (!$parent) {
            return response()->json(['message' => 'Parent not found'], 404);
        }
        return response()->json($parent);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $parent = ParentModel::find($id);
        if (!$parent) {
            return response()->json(['message' => 'Parent not found'], 404);
        }

        $request->validate([
            'email' => 'string|max:45|unique:parents,email,' . $id . ',parent_id',
            'password' => 'nullable|string|min:6',
            'fname' => 'string|max:45',
            'lname' => 'string|max:45',
            'dob' => 'nullable|date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
            'status' => 'boolean',
        ]);

        $parent->update([
            'email' => $request->email ?? $parent->email,
            'password' => $request->password ? Hash::make($request->password) : $parent->password,
            'fname' => $request->fname ?? $parent->fname,
            'lname' => $request->lname ?? $parent->lname,
            'dob' => $request->dob ?? $parent->dob,
            'phone' => $request->phone ?? $parent->phone,
            'mobile' => $request->mobile ?? $parent->mobile,
            'status' => $request->status ?? $parent->status,
            'last_login_ip' => $request->ip(),
        ]);

        return response()->json(['message' => 'Parent updated successfully', 'parent' => $parent]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $parent = ParentModel::find($id);
        if (!$parent) {
            return response()->json(['message' => 'Parent not found'], 404);
        }

        $parent->delete();
        return response()->json(['message' => 'Parent deleted successfully']);
    }
}
