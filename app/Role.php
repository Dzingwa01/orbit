<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    //
    protected $fillable = [
        'name', 'description', 'display_name',
    ];
}
