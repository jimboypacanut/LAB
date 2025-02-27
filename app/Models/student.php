<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    // use HasFactory; // Uncomment if you need factory support

    protected $table = 'student'; 
    protected $primaryKey = 'student_id'; 

    protected $fillable = [
        'email', 'password', 'fname', 'lname', 'dob', 'phone', 
        'mobile', 'status', 'last_login_date', 'last_login_ip'
    ];

    protected $hidden = ['password']; 
    protected $casts = [
        'dob' => 'date',
        'status' => 'boolean',
        'last_login_date' => 'datetime',
    ];
}
