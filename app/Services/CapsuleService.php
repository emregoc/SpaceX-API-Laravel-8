<?php 

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Capsule;
use App\Repositories\CapsuleRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class CapsuleService
{

    /**
     * @var $capsuleRepository
     */
    protected $capsuleRepository;

    /** CapsuleService Constructor
     * 
     * @param CapsuleRepository $capsuleRepository;
     */
    public function __construct(CapsuleRepository $capsuleRepository)
    {
        $this->capsuleRepository = $capsuleRepository;
    }


    public function showCapsules($status){

        if(!$status){
            return $this->capsuleRepository->getAllCapsules();
        }
        else if($status){
            return $this->capsuleRepository->getCapsuleByStatus($status);
        } 

    }

    public function showCapsuleInSerial($capsuleSerial){
        return $this->capsuleRepository->capsuleSerial($capsuleSerial);
    }
}

?>