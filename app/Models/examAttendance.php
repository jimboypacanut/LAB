<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAttendance extends Model
{
    use HasFactory;

    protected $table = 'exam_attendances';
    protected $primaryKey = 'exam_attendance_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'exam_id', 'student_id', 'status', 'remarks'
    ];

    public function exam()
    {
        return $this->belongsTo(Exams::class, 'exam_id', 'exam_id');
    }

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id', 'student_id');
    }
}
