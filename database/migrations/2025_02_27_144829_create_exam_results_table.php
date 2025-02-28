<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exam_results', function (Blueprint $table) {
            $table->unsignedBigInteger('exam_id'); // Must match exam_id in exams
            $table->unsignedBigInteger('student_id'); // Must match student_id in students
            $table->unsignedBigInteger('course_id'); // Must match course_id in courses
            $table->string('marks', 45);
        
            $table->foreign('exam_id')->references('exam_id')->on('exams')->onDelete('cascade');
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
        
            $table->primary(['exam_id', 'student_id', 'course_id']); // Composite Primary Key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};
