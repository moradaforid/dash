<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class TestMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $mailData, $language, $code;
    /**
     * Create a new message instance.
     */
    public function __construct($mailData, $language, $code)
    {
        $this->mailData = $mailData;
        $this->language = $language;
        $this->code = $code;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        // Temporarily set the locale
        $currentLocale = app()->getLocale();
        app()->setLocale($this->language);

        // Access the subject translation key
        $subject = __('emails.verification.subject', ['code' => $this->code]);

        // Restore the previous locale
        app()->setLocale($currentLocale);

        return new Envelope(
            subject: $subject,
            from: new Address('support@iptvdemon.com', 'Martin From IPTVDemon'),
        );




        // return new Envelope(
        //     subject: 'Your IPTV Test For 24h',
        //     from: new Address('support@iptvdemon.com', 'Martin From IPTVDemon'),
        // );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        // Temporarily set the locale
        $currentLocale = app()->getLocale();
        app()->setLocale($this->language);

        $greeting = __('emails.verification.greeting', ['name' => 'IPTV Fiesta']);
        $body = __('emails.verification.body');

        // Restore the previous locale
        app()->setLocale($currentLocale);

        return new Content(
            view: 'emails.verification',
            with: [
                'greeting' => $greeting,
                'body' => $body,
            ],
        );



        // return new Content(
        //     view: 'emails.test',
        // );
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
