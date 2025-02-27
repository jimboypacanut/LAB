<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ParentModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'parent'; // Make sure this matches your database table name

    protected $primaryKey = 'parent_id'; // Set custom primary key

    protected $fillable = [
        'email', 'password', 'fname', 'lname', 'dob', 'phone', 
        'mobile', 'status', 'last_login_date', 'last_login_ip'
    ];

    protected $hidden = ['password']; // Hide password from API responses

    protected $casts = [
        'dob' => 'date',
        'status' => 'boolean',
        'last_login_date' => 'datetime',
    ];
}
