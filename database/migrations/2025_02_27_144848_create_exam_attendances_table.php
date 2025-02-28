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
        Schema::create('exam_attendances', function (Blueprint $table) {
            $table->id('exam_attendance_id'); // UNSIGNED BIGINT PRIMARY KEY
            $table->unsignedBigInteger('exam_id'); // Must match exam_id in exams
            $table->unsignedBigInteger('student_id'); // Must match student_id in students
            $table->boolean('status')->default(true);
            $table->string('remarks', 100)->nullable();
            $table->timestamps();
        
            $table->foreign('exam_id')->references('exam_id')->on('exams')->onDelete('cascade');
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
        });
    }        

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_attendances');
    }
};
