<?php

namespace App\Mail\Admin;

use App\Models\Admin\Listing;
use App\Models\EmailTemplate;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ListingApproveEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $listing;
    /**
     * Create a new message instance.
     */
    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // {{ownername}}
        $subject = EmailTemplate::where('slug', 'listing-approve-email')->value('subject');
        $customer = User::where('id', $this->listing->user_id)->value('name');
        $subject = str_replace('{{ownername}}',$customer, $subject);
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
            view: 'emails.admin.listing_approve_email',
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
