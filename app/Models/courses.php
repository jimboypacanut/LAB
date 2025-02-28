<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $primaryKey = 'course_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name', 'description', 'grade_id'
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'grade_id');
    }
}
