<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
class VerifyEmailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $user; 
    /**
     * Create a new message instance.
     */
    public function __construct($username, User $user)
    {
        $this->username = $username;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('SHOP_MAIL_FROM'), env('APP_NAME'))
                    ->subject('Welcome to Our Application')
                    ->view('emails.verifyEmail')
                    ->with('username', $this->username)
                    ->with('user', $this->user); 
    }
}
