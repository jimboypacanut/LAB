<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    use HasFactory;

    protected $table = 'exams';
    protected $primaryKey = 'exam_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'exam_type_id', 'name', 'start_date'
    ];

    public function examType()
    {
        return $this->belongsTo(ExamTypes::class, 'exam_type_id', 'exam_type_id');
    }
}
