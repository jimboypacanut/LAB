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
        Schema::create('exam', function (Blueprint $table) {
            $table->id('exam_id'); // Auto-increment primary key
            $table->unsignedBigInteger('exam_type_id'); // Foreign key to exam_types
            $table->string('name', 45);
            $table->date('start_date');

            // Foreign key constraint
            $table->foreign('exam_type_id')->references('exam_type_id')->on('exam_types')->onDelete('cascade');

            $table->timestamps(); // Adds created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam');
    }
};
