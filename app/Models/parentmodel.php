<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ParentModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'parents';
    protected $primaryKey = 'parent_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'email', 'password', 'fname', 'lname', 'dob', 'phone',
        'mobile', 'status', 'last_login_date', 'last_login_ip'
    ];

    protected $hidden = [
        'password',
    ];
}
