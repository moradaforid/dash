<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class Trial extends Mailable
{
    use Queueable, SerializesModels;
    public $mailData, $language;
    /**
     * Create a new message instance.
     */
    public function __construct($mailData, $language)
    {
        $this->mailData = $mailData;
        $this->language = $language;
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
        $subject = __('emails.trial.subject', ['brand_name' => $this->mailData['brand_name']]);


        // Restore the previous locale
        app()->setLocale($currentLocale);

        return new Envelope(
            subject: $subject,
            from: new Address($this->mailData['from_email'], $this->mailData['from_name']),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        // Temporarily set the locale
        $currentLocale = app()->getLocale();
        app()->setLocale($this->language);

        // $greeting = __('emails.verification.greeting', ['brand_name' => $this->mailData['brand_name']]);
        // $body = __('emails.verification.body', ['brand_name' => $this->mailData['brand_name'], 'code' => $this->mailData['code']]);

        // Restore the previous locale
        app()->setLocale($currentLocale);

        return new Content(
            view: 'emails.trial',
            // with: [
            //     'greeting' => $greeting,
            //     'body' => $body,
            // ],
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
