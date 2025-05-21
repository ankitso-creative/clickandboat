<?php

namespace App\Mail\Admin;

use App\Models\EmailTemplate;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserChangeStatusEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        if($this->user->status==1):
            $subject = EmailTemplate::where('slug', 'active-usere-eail')->value('subject');
            return new Envelope(
                subject: ''.$subject,
            );
        else:
            $subject = EmailTemplate::where('slug', 'account-registration-email')->value('subject');
            return new Envelope(
                subject: ''.$subject,
            );
        endif;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if($this->user->status==1):
            return new Content(
                view: 'emails.user.activeuseremail',
            );
        else:
            return new Content(
                view: 'emails.user.rejectuseremail',
            );
        endif;
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
