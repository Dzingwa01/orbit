<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class ScheduleInviteMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user;
    protected $team_name;
    protected  $email_token;

    public function __construct(User $user,$team_name,$email_token)
    {
        //
        $this->user = $user;
        $this->team_name = $team_name;
        $this->email_token = $email_token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $email = new \App\Mail\ScheduleInviteMail($this->user,$this->team_name,$this->email_token);
        Mail::to($this->user->email)->send($email);
        $this->release(2);
    }
}
