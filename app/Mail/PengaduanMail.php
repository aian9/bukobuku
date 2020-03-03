<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $link, $subject, $deskripsi;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->link = $data["link"];
        $this->subject = $data["subject"];
        $this->deskripsi = $data["deskripsi"];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->view('email.pengaduan')->with([
            'link' => $this->link,
            'subject' => $this->subject,
            'deskripsi' => $this->deskripsi
        ])->from('noreply@sapaguru.com', 'SapaGuru')->subject($this->subject);
    }
}
