<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
    protected $fillable = ['package_name','number_of_members','package_prices','discount','package_description'];
}
