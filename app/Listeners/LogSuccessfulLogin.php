<?php
namespace App\Listeners;

use App\Models\LoginHistories;
use Illuminate\Auth\Events\Login;

class LogSuccessfulLogin
{
    public function handle(Login $event)
    {
        $user = $event->user;

        LoginHistories::create([
            'user_id' => $user->id,
            'login_at' => now(),
        ]);
    }
}