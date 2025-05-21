<?php

namespace App\Mail\Front;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\UploadedFile;

class CancelBookingMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $order;
   

    public function __construct($order)
    {
        $this->order = $order;
       
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = EmailTemplate::where('slug', 'booking-cancel-email')->value('subject');
        $subject = str_replace('{{check_in}}',$this->order->order->check_in, $subject);
        return new Envelope(
            subject: ''.$subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.front.cancelbooking',
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
