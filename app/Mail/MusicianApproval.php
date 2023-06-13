<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Musician;
use Illuminate\Support\Str;


class MusicianApproval extends Mailable
{
    use Queueable, SerializesModels;

     public $musician;
    public $token;

    /**
     * Create a new message instance.
     *
     * @param  Musician  $musician
     * @param  string  $token
     * @return void
     */
     public function __construct(Musician $musician, $token)
    {
        $this->musician = $musician;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $password = Str::random(8);
        return $this->from('subhasri4268@gmail.com', 'Subhasri')
            ->subject('Musician Approval')
            ->view('emails.musician_approval')
             ->with([
            'username' => $this->musician->email,
            'password' => $password,
            'token' => $this->token,
        ]);
    }
}
