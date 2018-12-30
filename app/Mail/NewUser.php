<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $random_pas;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $random_pas)
    {
        $this->random_pas = $random_pas;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.users.new')
                    ->subject('DoubleSides');
    }
}
