<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShiftSchedule extends Model
{
    //
    protected $fillable = ['shift_date','employee_id','shift_id'];
//    protected $dates = ['shift_date'];
}
