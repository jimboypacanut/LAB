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
        Schema::create('classroom_student', function (Blueprint $table) {
            $table->unsignedBigInteger('classroom_id');
            $table->unsignedBigInteger('student_id');

            // Foreign key constraints
            $table->foreign('classroom_id')->references('classroom_id')->on('classroom')->onDelete('cascade');
            $table->foreign('student_id')->references('student_id')->on('student')->onDelete('cascade');

            // Composite primary key
            $table->primary(['classroom_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_student');
    }
};
