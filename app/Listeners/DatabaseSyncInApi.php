<?php

namespace App\Listeners;

use App\Events\SyncApi;
use App\Models\Capsule;
use App\Models\Mission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class DatabaseSyncInApi
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
     * @param  \App\Events\SyncApi  $event
     * @return void
     */
    public function handle(SyncApi $event)
    {
        $json_data = $event->data;
        $datas = json_decode($json_data);

        $j = 0;
        $l = 0;
        $count = 0;

        foreach($datas as $apidata){
            if(!$apidata->missions){ 
                $count++;
            }
            foreach($apidata->missions as $mission){
                $count++;
            }
        }
      
        foreach($datas as $data){
            Capsule::updateOrCreate([
                "capsule_serial" => $data->capsule_serial,
            ],[
                "capsule_serial" => $data->capsule_serial,
                "capsule_id" => $data->capsule_id,
                "status" => $data->status,
                "original_launch" => $data->original_launch,
                "original_launch_unix" => $data->original_launch_unix,
                "landings" => $data->landings,
                "type" => $data->type,
                "details" => $data->details,
                "reuse_count" => $data->reuse_count,
            ]);
            //$lastCapsuleId = Capsule::latest('id')->first();

            $i = 0; 
            $capsules = Capsule::all();
            foreach($capsules as $capsule){ // capsule'nin gorevi varsa o goreve capsule id'yi atamak icin kullandik
                $capsuleId[$i] = $capsule->id;            
                $i++;                      
            }          

            $k = 0; 
            $missions = Mission::all();
            foreach($missions as $mission){ // mission id leri aldik buna gore update islemi yaptik
                $missionId[$k] = $mission->id;    
                $k++;                     
            } 
           

            if(count($missions) < $count){ // veritaban??nda ki veriler AP?? deki verilerden az ise ekle
                foreach($data->missions as $mission){
                    Mission::updateOrCreate([
                        "capsule_id" => $capsuleId[$j],
                        "capsule_serial" => $data->capsule_serial,
                        "name" => $mission->name,
                        "flight" => $mission->flight,
                    ]);
                 }
                 if(!$data->missions){ // burada mission olmayan capsullere bos deger atilmazsa 
                    Mission::updateOrCreate([//[ // updateOrCreate komutu duzgun calismiyor id farkindan dolayi
                        "capsule_id" => $capsuleId[$j],
                        "capsule_serial" => $data->capsule_serial,
                        "name" => null,
                        "flight" => null
                     ]);
                 }
            }
            else if(count($missions) == $count ){ // veritaban??nda ki veriler API deki veriler e??itse guncelle 
                foreach($data->missions as $mission){
                    Mission::updateOrCreate([
                        "id" =>$missionId[$l],
                    ],
                    [
                        "capsule_id" => $capsuleId[$j],
                        "capsule_serial" => $data->capsule_serial,
                        "name" => $mission->name,
                        "flight" => $mission->flight,
                    ]);
                   $l++;
            }

            if(!$data->missions){ 
                Mission::updateOrCreate([
                    "id" =>$missionId[$l],
                ],
                [
                    "capsule_id" => $capsuleId[$j],
                    "capsule_serial" => $data->capsule_serial,
                    "name" => null,
                    "flight" => null
                 ]);
                 $l++;
             }
            }
          
          $j++;
           
        }
        Log::info($json_data);
    }
}
