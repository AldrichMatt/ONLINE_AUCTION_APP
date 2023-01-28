<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    use HasFactory;

    protected $fillable = [
        'employee_name',
        'username',
        'password',
        'level'
    ];
}
