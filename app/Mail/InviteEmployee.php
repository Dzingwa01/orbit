<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteEmployee extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $password;

    public function __construct(User $user,$password)
    {
        //
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.employee_invite')->with([
            'url' => 'http://169.60.184.102/verify_email/'.$this->user->email_token,
            'name'=>$this->user->name,
            'surname'=>$this->user->surname,
            'user_name'=>$this->user->email,
            'password'=>$this->password
        ]);
    }
}
