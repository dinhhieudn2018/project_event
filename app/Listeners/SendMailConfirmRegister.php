<?php

namespace App\Listeners;

use App\Events\Register;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Mail\RegisterMail;
use App\Notifications\NotificationEmail;
class SendMailConfirmRegister implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Register  $event
     * @return void
     */
    public function handle(Register $event)
    {
        //echo "success";
        //Mail::to($event->user->email)->send(new RegisterMail($event->user));
        $event->user->notify(new NotificationEmail());
    }
}
