<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the courses.
     */
    public function index()
    {
        return response()->json(Course::with('grade')->get(), 200);
    }

    /**
     * Store a newly created course.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'required|integer|unique:course,course_id',
            'name' => 'required|string|max:45',
            'description' => 'required|string|max:45',
            'grade_id' => 'required|exists:grade,grade_id',
        ]);

        $course = Course::create($validatedData);
        return response()->json($course, 201);
    }

    /**
     * Display the specified course.
     */
    public function show($id)
    {
        $course = Course::with('grade')->find($id);
        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }
        return response()->json($course, 200);
    }

    /**
     * Update the specified course.
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'string|max:45',
            'description' => 'string|max:45',
            'grade_id' => 'exists:grade,grade_id',
        ]);

        $course->update($validatedData);
        return response()->json($course, 200);
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $course->delete();
        return response()->json(['message' => 'Course deleted'], 200);
    }
}
