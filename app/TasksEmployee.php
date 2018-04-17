<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasksEmployee extends Model
{
    //
    protected $fillable = ['task_id','employee_id','team_id'];
}
