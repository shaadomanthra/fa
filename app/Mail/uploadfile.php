<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class uploadfile extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $filename;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$filename)
    {
        $this->user = $user;
        $this->filename = $filename;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('File upload by '.$this->user->name.' - '.$this->filename)->markdown('mail.fileupload');
    }
}
