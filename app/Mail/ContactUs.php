<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    public $from;
    public $name;
    public $text;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from, $name, $text)
    {
        $this->email_address = $from;
        $this->name = $name;
        $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.users.contactus')
                    ->with([
                        'email_address' => $this->email_address,
                        'name' => $this->name,
                        'text' => $this->text
                    ]);
    }
}
