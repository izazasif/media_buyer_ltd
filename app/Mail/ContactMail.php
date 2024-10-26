<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $phone;
    public $subject;
    public $body;

    public function __construct($name, $email, $phone, $subject, $body)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->subject = "Contact Email";
        $this->body = $body;
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->html("
                        <p><strong>Name:</strong> {$this->name}</p>
                        <p><strong>Email:</strong> {$this->email}</p>
                        <p><strong>Phone:</strong> {$this->phone}</p>
                        <p><strong>Message:</strong><br>{$this->body}</p>
                    ");
    }
}

