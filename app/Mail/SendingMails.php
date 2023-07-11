<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SendingMails extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $message;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param string $message
     * @return void
     */
    public function __construct($subject, $message)
    {
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        $messageContent = $this->message;

        return $this->from('cheikhaldieys@gmail.com', 'aldiey')
            ->subject($this->subject)
            ->view('emails')
            ->with([
                'messageContent' => $messageContent,
            ])
            ->attach($this->getAttachmentPath())
            ->attach($this->getAttachmentPath2());
    }

    /**
     * Get the attachment path.
     *
     * @return string
     */
    public function getAttachmentPath()
    {
        return public_path('bg.jpg');
    }
    public function getAttachmentPath2()
    {
        return public_path('bg.jpg');
    }

}