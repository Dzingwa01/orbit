<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    //
    protected $fillable = ['shift_title','start_date','end_date','creator_id','team_id'];
}
