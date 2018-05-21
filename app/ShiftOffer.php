<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShiftOffer extends Model
{
    //
    protected $fillable = ['offer_shit','team_member','reason','employeed_id','approval'];
}
