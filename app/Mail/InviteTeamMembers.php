<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteTeamMembers extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $email_token;

    public function __construct(User $user,$email_token)
    {
        //
        $this->user = $user;
        $this->email_token = $email_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invite_team_members')->with([
            'url' => 'http://18.220.238.181/invite_team_member/'.$this->email_token,
            'name'=>$this->user->name,
            'surname'=>$this->user->surname,
        ]);
    }
}
