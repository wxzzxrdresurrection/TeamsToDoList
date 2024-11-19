<?php

namespace App\Jobs;

use App\Mail\NewPasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class Mailer implements ShouldQueue
{
    use Queueable;

    protected $email, $username, $data;

    /**
     * Create a new job instance.
     */
    public function __construct(string $email, string $username, string $data)
    {
        $this->email = $email;
        $this->username = $username;
        $this->data = $data;   
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new NewPasswordMail($this->username, $this->data));
    }
}
