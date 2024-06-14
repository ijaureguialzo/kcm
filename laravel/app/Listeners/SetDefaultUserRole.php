<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class SetDefaultUserRole
{
    public function handle(Registered $event): void
    {
        $event->user->assignRole('subscriber');
    }
}
