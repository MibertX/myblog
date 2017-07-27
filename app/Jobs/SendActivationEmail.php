<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;

use App\Models\User;

class SendActivationEmail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $data = [
            'title' => 'Confirm Registration',
            'activation_code' => $this->user->activationCode
        ];

        $mailer->send('email.activation', $data, function($message)
        {
            $message->to($this->user->email, $this->user->login)
                ->subject('Confirm registration');
        });

    }
}
