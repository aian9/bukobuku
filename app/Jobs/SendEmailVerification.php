<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmailVerification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user,$link, $email, $url;

    public $tries = 10;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $link)
    {
        $this->user = $user;
        $this->link = $link;
        $this->email = $user->email;
        $data["link"]= array('link' => $this->link,'email'=> $this->email);
        
        Mail::to($this->user->email)->send(new \App\Mail\EmailVerification($data));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        $data["link"]= array('link' => $this->link,'email'=> $this->email);

        Mail::to($this->user->email)->send(new \App\Mail\EmailVerification($data));
    }
}
