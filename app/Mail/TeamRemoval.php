<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TeamRemoval extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.team_removal')->with([
            'name'=>$this->user->name,
            'surname'=>$this->user->surname,
            'team_name'=>$this->team_name
        ]);
    }
}
