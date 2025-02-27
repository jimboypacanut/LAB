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
        Schema::create('course', function (Blueprint $table) {
            $table->integer('course_id')->primary();
            $table->string('name', 45);
            $table->string('description', 45);
            $table->unsignedBigInteger('grade_id'); // Foreign key reference

            // Foreign key constraint
            $table->foreign('grade_id')->references('grade_id')->on('grade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};
