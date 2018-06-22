<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingMaterial extends Model
{
    //
    protected $fillable = ['name','description','file_url','creator_id'];

}
