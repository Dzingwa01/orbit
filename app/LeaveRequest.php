<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
protected $fillable = ['off_start_date','off_end_date','off_start_time','off_end_time','leave_type','off_category','reason','employee_id'];
}
