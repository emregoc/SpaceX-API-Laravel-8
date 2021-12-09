<?php

namespace App\Http\Controllers;

use App\Models\Capsule;
use App\Models\Mission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SpacexController extends Controller
{
    public function postData(){
       // $users = User::all()->where('is_admin', 1)->first();
        //echo '<pre>';
        //var_dump($users->name);
        //exit;
       /* $api = "https://api.spacexdata.com/v3/capsules";
        $json_data = file_get_contents($api);
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
           

            if(count($missions) < $count){ // veritabanında ki veriler APİ deki verilerden az ise ekle
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
            else if(count($missions) == $count ){ // veritabanında ki veriler API deki veriler eşitse guncelle 
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
        $getData = Capsule::with('missions')
                            ->get();
        return $getData;
        echo 'başarılı';

        $getData = Capsule::with('missions')
                            ->select('capsules.*')->get();
        return $getData;*/
    }

}
