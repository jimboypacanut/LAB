<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classrooms extends Model
{
    use HasFactory;

    protected $table = 'classrooms';
    protected $primaryKey = 'classroom_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'year', 'grade_id', 'section', 'status', 'remarks', 'teacher_id'
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'grade_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'teacher_id', 'teacher_id');
    }
}