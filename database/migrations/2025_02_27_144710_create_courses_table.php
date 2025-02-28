<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id('course_id'); // UNSIGNED BIGINT PRIMARY KEY
            $table->string('name', 45);
            $table->string('description', 45);
            $table->unsignedBigInteger('grade_id'); // Must match 'grade_id' in grades
            $table->foreign('grade_id')->references('grade_id')->on('grades')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
