<?php

namespace App\Listeners;

use App\Events\SendMail;
use App\Models\LoginHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserSendMail
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
     * @param  \App\Events\SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        $userData = $event->user;

        $array = [
            'name' => $userData->name, 
            'email' => $userData->email, 
            'date' => date("Y-m-d"),
        ];

        $userEmail = $userData->email;
        Mail::send('mail', $array, function($message) use ($userEmail){
            $message->subject('Sync Completed');
            $message->to($userEmail);
        });

        Log::info($userData->email . ' '  . '  mail gonderildi');

    }
}
