<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'course';
    protected $primaryKey = 'course_id';
    public $incrementing = false;
    protected $keyType = 'integer';

    protected $fillable = ['course_id', 'name', 'description', 'grade_id'];

    /**
     * Relationship: A course belongs to a grade.
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'grade_id');
    }
}
