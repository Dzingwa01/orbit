<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShiftOffer extends Model
{
    //
    protected $fillable = ['offer_shift','team_member','reason','employee_id','approval'];
}
