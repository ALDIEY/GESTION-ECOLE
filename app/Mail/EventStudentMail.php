<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventStudentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $eventName;
    public $eventDescription;
    
    public function __construct($event) {
        $this->eventName = $event->name;
        $this->eventDescription = $event->description;    
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Event Student Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content()
    {
       
            return $this->view('eventStudentMail');  
        
    }
    public function build()
    {
        return $this->view('eventStudentMail');  
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
