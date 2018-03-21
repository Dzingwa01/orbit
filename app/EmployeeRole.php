<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeRole extends Model
{
    //
    protected $fillable = [
        'role_name', 'role_description', 'role_display_name','role_creator'
    ];
}
