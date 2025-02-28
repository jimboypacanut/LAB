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
            $table->id('classroom_id');
            $table->year('year');
            $table->unsignedBigInteger('grade_id'); // Ensure it is UNSIGNED BIGINT
            $table->char('section', 2);
            $table->boolean('status')->default(true);
            $table->string('remarks', 45)->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            
            $table->foreign('grade_id')->references('grade_id')->on('grades')->onDelete('cascade');
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('set null');
            
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
