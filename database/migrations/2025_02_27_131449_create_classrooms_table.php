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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->integer('classroom_id')->primary();
            $table->integer('year');
            $table->unsignedBigInteger('grade_id'); // Foreign key reference
            $table->char('section', 2);
            $table->boolean('status');
            $table->string('remarks', 45);
            $table->unsignedBigInteger('teacher_id'); // Foreign key reference

            // Foreign key constraints
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};