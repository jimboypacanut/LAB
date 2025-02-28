<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassroomStudents extends Pivot
{
    use HasFactory;

    protected $table = 'classroom_student';
    public $incrementing = false;
    protected $primaryKey = null; // No single primary key since it's composite
    public $timestamps = false;

    protected $fillable = [
        'classroom_id', 'student_id'
    ];
}
