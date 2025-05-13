<?php

namespace App\Mail\Front;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\UploadedFile;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $emailData;
   

    public function __construct($emailData)
    {
        $this->emailData = $emailData;
       
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $name = $this->emailData->request['name'];
        return new Envelope(
            subject: 'New Enquiry - '.$name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.front.enquiry',
        );
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
