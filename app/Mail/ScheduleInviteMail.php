<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScheduleInviteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $team_name;
    protected $email_token;

    public function __construct(User $user,$team_name,$email_token)
    {
        //
        $this->user = $user;
        $this->team_name = $team_name;
        $this->email_token = $email_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.send_schedule_invite')->with([
            'url' => 'http://169.60.184.102/invite_team_member/'.$this->email_token,
            'name'=>$this->user->name,
            'surname'=>$this->user->surname,
            'team_name'=>$this->team_name
        ]);
    }
}
