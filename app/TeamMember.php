<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    //
    protected $fillable = ['member_team_id','team_member_id','verified','email_token'];
}
