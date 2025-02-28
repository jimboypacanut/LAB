<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ExamResults extends Pivot
{
    use HasFactory;

    protected $table = 'exam_results';
    public $incrementing = false;
    protected $primaryKey = null; // No single primary key (composite key)
    public $timestamps = false;

    protected $fillable = [
        'exam_id', 'student_id', 'course_id', 'marks'
    ];

    public function exam()
    {
        return $this->belongsTo(Exams::class, 'exam_id', 'exam_id');
    }

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id', 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'course_id');
    }
}
