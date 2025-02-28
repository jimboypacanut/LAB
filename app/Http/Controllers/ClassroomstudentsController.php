<?php

namespace App\Http\Controllers;

use App\Models\Classrooms;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class ClassroomStudentsController extends Controller
{
    /**
     * Assign a student to a classroom.
     */
    public function assignStudent($classroom_id, $student_id)
    {
        $classroom = Classrooms::find($classroom_id);
        $student = Students::find($student_id);

        if (!$classroom || !$student) {
            return response()->json(['message' => 'Classroom or Student not found'], 404);
        }

        $classroom->students()->attach($student_id);
        return response()->json(['message' => 'Student assigned to classroom successfully']);
    }

    /**
     * Remove a student from a classroom.
     */
    public function removeStudent($classroom_id, $student_id)
    {
        $classroom = Classrooms::find($classroom_id);
        $student = Students::find($student_id);

        if (!$classroom || !$student) {
            return response()->json(['message' => 'Classroom or Student not found'], 404);
        }

        $classroom->students()->detach($student_id);
        return response()->json(['message' => 'Student removed from classroom successfully']);
    }
}
