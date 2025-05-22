<?php

namespace App\Mail\Front;

use App\Models\Admin\Listing;
use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\UploadedFile;

class CompleteBookingMail extends Mailable
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
        $subject = Listing::where('id', $this->order->order->listing_id)->first();
        $subject = $subject->type.' '.$subject->manufacturer.' '.$subject->model;
        return new Envelope(
            subject: 'Rate your experience with - '.$subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.front.completebooking',
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
