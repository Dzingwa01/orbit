<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SwapShift extends Model
{
    //
    protected $fillable = ['swap_shift','with_shift','reason','employee_id','requestor_id','approval'];
}
