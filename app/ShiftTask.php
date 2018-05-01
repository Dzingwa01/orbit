<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShiftTask extends Model
{
    //
    protected $fillable = ['employee_id','shift_id','task_id'];
}
