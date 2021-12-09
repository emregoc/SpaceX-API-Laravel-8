<?php

namespace App\Repositories;

use App\Models\Capsule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class CapsuleRepository
{

    /**
     * @var Capsule
     */
    protected $capsule;

    /**
     * 
     * @param Capsule $capsule;
     */
    public function __construct(Capsule $capsule)
    {
        $this->capsule = $capsule;
    }

    public function getAllCapsules(){
        $getData = Capsule::with('missions')
                    ->select('capsules.*')->get();

        return $getData;
    }

    public function getCapsuleByStatus($status){
        $getData = Capsule::with('missions')
                                ->where('status', $status)->select('capsules.*')->get();

        if(count($getData) > 0){
            return $getData;
         }
        else if(count($getData) == 0){
            throw new InvalidArgumentException();
        }
    }

    public function capsuleSerial($capsuleSerial){
        $getData = Capsule::with('missions')
                                ->where('capsule_serial', $capsuleSerial)->select('capsules.*')->get();
        if(count($getData) > 0){
            return $getData;
        }
        else if(count($getData) == 0){
            throw new InvalidArgumentException();
        }
    }

}

?>