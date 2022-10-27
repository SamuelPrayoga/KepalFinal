<?php

namespace App\Listeners\Auth;

use App\Events\Auth\UserActivationEmail;
use App\Mail\Auth\ActivationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use App\User;
use App\Events\Auth\OrderDetailsEv;

class SendOrderDetails
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
     * @param  OrderDetailsEv  $event
     * @return void
     */
    public function handle(OrderDetailsEv $event)
    {
        Mail::to($event->detailorder->detailorder)->send(new Ordemail($event->detailorder));
    }
}
