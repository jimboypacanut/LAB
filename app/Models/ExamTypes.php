<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamTypes extends Model
{
    use HasFactory;

    protected $table = 'exam_types';
    protected $primaryKey = 'exam_type_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name', 'desc'
    ];
}
