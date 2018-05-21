<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SwapShift extends Model
{
    //
    protected $fillable = ['swap_shift','with_shift','reason','employeed_id','approval'];
}
