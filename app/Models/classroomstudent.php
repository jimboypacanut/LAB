<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomStudent extends Model
{
    use HasFactory;

    protected $table = 'classroom_student';
    protected $fillable = ['classroom_id', 'student_id'];
}
