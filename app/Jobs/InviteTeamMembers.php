<?php

namespace App\Jobs;

use App\TeamMember;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class InviteTeamMembers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user;
    protected $team_member;

    public function __construct(TeamMember $teamMember)
    {
        //
        $user = User::where('id',$teamMember->team_member_id)->first();
        $this->team_member = $teamMember;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $email = new \App\Mail\InviteTeamMembers($this->user,$this->team_member->email_token);
        Mail::to($this->user->email)->send($email);
        $this->release(5);
    }
}
