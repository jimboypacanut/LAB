<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $table = 'classroom';
    protected $primaryKey = 'classroom_id';
    public $incrementing = false;
    protected $keyType = 'integer';

    protected $fillable = ['classroom_id', 'year', 'grade_id', 'section', 'status', 'remarks', 'teacher_id'];

    /**
     * Relationship: A classroom belongs to a grade.
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    /**
     * Relationship: A classroom belongs to a teacher.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
}
