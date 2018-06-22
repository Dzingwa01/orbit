<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['shift_title','start_date','end_date','creator_id','team_id','shift_description','start_time','end_date','end_time'];

    public function shiftTasks(){
        return $this->hasMany('App\ShiftTask');
    }


}
