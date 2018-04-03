<?php

namespace App\Jobs;

use App\Mail\TeamRemoval;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class TeamRemovals implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user;
    protected $team_name;

    public function __construct(User $user,$team_name)
    {
        //
        $this->user = $user;
        $this->team_name = $team_name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $email = new TeamRemoval($this->user,$this->team_name);
        Mail::to($this->user->email)->send($email);
        $this->release(2);
    }
}
