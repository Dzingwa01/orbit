<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnBoardingMaterial extends Model
{
    //
    protected $fillable = ['name','description','file_url','creator_id'];
}
