<?php

namespace App\Listeners;

use App\Events\LoginHistory;
use App\Models\LoginHistory as ModelsLoginHistory;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class storeUserLoginHistory
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
     * @param  \App\Events\LoginHistory  $event
     * @return void
     */
    public function handle(LoginHistory $event)
    {

        $userinfo = $event->user;
     
        $saveHistory = ModelsLoginHistory::create([
            'name' => $userinfo->name, 
            'email' => $userinfo->email, 
        ]);
       
        return $saveHistory;
    }
}
