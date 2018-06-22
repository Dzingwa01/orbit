<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShiftSchedule extends Model
{
    //
    protected $fillable = ['shift_date','employee_id','shift_id'];

    public function swapShifts(){
        return $this->hasMany('App\SwapShift','swap_shift');
    }

    public function shiftOffers(){
        return $this->hasMany('App\ShiftOffer','offer_shift');
    }
}
