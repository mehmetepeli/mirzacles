<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    protected $dispatchesEvents = [
        'saved' => \App\Events\UserSaved::class,
    ];

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
