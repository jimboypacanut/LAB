<?php 

use App\Http\Controllers\TeachersController;
use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ParentmodelController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ClassroomStudentsController;
use App\Http\Controllers\ExamTypesController;
use App\Http\Controllers\ExamsController;
use App\Http\Controllers\ExamResultsController;
use App\Http\Controllers\ExamAttendanceController;


Route::apiResource('teachers', TeachersController::class);
Route::apiResource('classrooms', ClassroomsController::class);
Route::apiResource('grades', GradeController::class);
Route::apiResource('parents', ParentmodelController::class);
Route::apiResource('students', StudentsController::class);
Route::apiResource('courses', CoursesController::class);
Route::apiResource('classroomStudents', ClassroomStudentsController::class);
Route::apiResource('examtypes', ExamTypesController::class);
Route::apiResource('exam', ExamsController::class);
Route::apiResource('examResult', ExamResultsController::class);
Route::apiResource('examAttendance', ExamAttendanceController::class);


