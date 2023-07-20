<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\{Role, UserBillingProvider, User, UserInvite};

class InviteUserCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $invite; 

    public function __construct(UserInvite $invite)
{
    $this->invite = $invite;
}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('priyapriyanka.pk1985@gmail.com')
                ->view('emails.invite');
    }
}
