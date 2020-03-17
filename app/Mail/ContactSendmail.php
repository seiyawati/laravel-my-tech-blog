<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSendmail extends Mailable
{
    use Queueable, SerializesModels;

    private $email;
    private $name;
    private $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
        $this->email = $inputs['email'];
        $this->name = $inputs['name'];
        $this->body = $inputs['body'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('kid960805@gmail.com')
                    ->subject('SeiyaBlog 受付完了メール')
                    ->view('contacts.mail')
                    ->with([
                        'email' => $this->email,
                        'name' => $this->name,
                        'body' => $this->body,
                    ]);
    }
}
