<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Students extends Authenticatable
{
    use HasFactory;

    protected $table = 'students';
    protected $primaryKey = 'student_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'email', 'password', 'fname', 'lname', 'dob', 'phone',
        'mobile', 'parent_id', 'date_of_join', 'status',
        'last_login_date', 'last_login_ip'
    ];

    protected $hidden = [
        'password',
    ];

    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parent_id', 'parent_id'); 
    }
}
