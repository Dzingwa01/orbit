<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    //
    protected $fillable = ['description','name','start_date','end_date','creator_id','picture_url'];
}
