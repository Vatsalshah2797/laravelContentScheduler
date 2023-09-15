<?php

namespace App\Mail;

//use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
//use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Content;

class ContentEmail extends Mailable
{
    //use Queueable, SerializesModels;

    public $content;

    /**
     * Create a new message instance.
     *
     * @param  \App\Content  $content
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Ready to go for New Launch')
                    ->markdown('emails.content'); // Use a Blade view for email content
    }
}
