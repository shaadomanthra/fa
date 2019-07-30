<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class reviewnotify extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $test;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$test)
    {
        $this->user = $user;
        $this->test = $test;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Test review - '.$this->test->name.' - First Academy')->markdown('mail.reviewnotify');
    }
}
