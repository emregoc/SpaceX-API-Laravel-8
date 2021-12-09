<?php

namespace App\Console\Commands;

use App\Events\LoginHistory;
use App\Events\SendMail;
use App\Events\SyncApi;
use App\Models\SpacexData;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * php artisan send:data
     * 
     * @var string
     */
    protected $signature = 'send:data';

    /**
     * The console command description.
     *
     * 
     * 
     * @var string
     */
    protected $description = 'Epigra case';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $api = "https://api.spacexdata.com/v3/capsules";
        $json_data = file_get_contents($api);
        

         event(new SyncApi($json_data));

         $users = User::all()->where('is_admin', 1)->first(); // bunun yerine giris yapan kullaniciyi alicaz
         //event(new LoginHistory($users));
         event(new SendMail($users));
        
    }
}
