<?php

namespace App\Listeners;

use App\Events\UserRegister;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailForRegister
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegister $event): void
    {
        Mail::raw("Thanks for working",
            function ($message) use ($event) {
            $message->to($event->user->email);
            $message->subject("Thanks for working");
        });
    }
}
