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
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id'); // Ensures an unsigned big integer primary key
            $table->string('email', 45)->unique();
            $table->string('password', 255);
            $table->string('fname', 45);
            $table->string('lname', 45);
            $table->date('dob')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('mobile', 15)->nullable();
            $table->unsignedBigInteger('parent_id')->nullable(); // Must match 'parent_id' in parents
            $table->foreign('parent_id')->references('parent_id')->on('parents')->onDelete('cascade');
            $table->date('date_of_join')->nullable();
            $table->boolean('status')->default(true);
            $table->dateTime('last_login_date')->nullable();
            $table->string('last_login_ip', 45)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
