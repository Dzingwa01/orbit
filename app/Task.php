<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    //
    protected $fillable = ['description','name','task_date','creator_id','picture_url'];
}
