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
        Schema::create(table: 'teacher', callback: function (Blueprint $table): void {
            $table->id(column: 'teacher_id'); // Auto-increment primary key
            $table->string(column: 'email', length: 45)->unique();
            $table->string(column: 'password', length: 255); // Increased length for hashed passwords
            $table->string(column: 'fname', length: 45);
            $table->string(column: 'lname', length: 45);
            $table->date(column: 'dob');
            $table->string(column: 'phone', length: 15)->nullable();
            $table->string(column: 'mobile', length: 15)->nullable();
            $table->boolean(column: 'status')->default(1);
            $table->dateTime(column: 'last_login_date')->nullable();
            $table->string(column: 'last_login_ip', length: 45)->nullable();
            $table->timestamps(); // Adds created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher');
    }
};
