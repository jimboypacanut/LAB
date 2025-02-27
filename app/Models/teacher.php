<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'teacher';
    protected $primaryKey = 'teacher_id';

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
