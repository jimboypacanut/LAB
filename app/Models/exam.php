<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExamType;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exam';
    protected $fillable = ['exam_type_id', 'name', 'start_date'];

    /**
     * Relationship: An exam belongs to an exam type.
     */
    public function examType()
    {
        return $this->belongsTo(ExamType::class, 'exam_type_id', 'exam_type_id');
    }
}
