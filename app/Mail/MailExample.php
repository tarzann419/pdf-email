<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailExample extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */

    //  subject property in the envelope is used to set the subject of the email.
    public function envelope()
    {
        return new Envelope(
            subject: $this->mailData['title'],
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.test_mail',
            with: $this->mailData,
        );
    }

    /**
     * Get the attachments for the message.
     * this code assumes that it's working with PDF data.
     * @return array
     */
    public function attachments()
    {
        return [
            Attachment::fromData(fn () => $this->mailData['pdf']->output(), 'report.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
