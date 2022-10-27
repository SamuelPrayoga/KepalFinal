<?php

namespace App\Events\Auth;

use App\Detailorder;
use App\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class UserActivationEmail
{
    use Dispatchable, SerializesModels;

    public $detailorder;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Detailorder $detailorder)
    {
        $this->detailorder = $detailorder;
    }

}
