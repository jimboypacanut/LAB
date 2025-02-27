<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamResultController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClassroomStudentController;
use App\Http\Controllers\ParentmodelController;

// API Resource Routes for CRUD Operations
Route::apiResource('student', StudentController::class);
Route::apiResource('teacher', TeacherController::class);
Route::apiResource('grade', GradeController::class);
Route::apiResource('course', CourseController::class);
Route::apiResource('classroom', ClassroomController::class);
Route::apiResource('exam-type', ExamTypeController::class);
Route::apiResource('exam', ExamController::class);
Route::apiResource('exam-result', ExamResultController::class);
Route::apiResource('attendance', AttendanceController::class);
Route::apiResource('classroom-student', ClassroomStudentController::class);
Route::apiResource('parent', ParentmodelController::class);
