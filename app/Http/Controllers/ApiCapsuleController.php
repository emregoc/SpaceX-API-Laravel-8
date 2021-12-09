<?php

namespace App\Http\Controllers;

use App\Models\Capsule;
use App\Models\User;
use App\Services\CapsuleService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiCapsuleController extends Controller
{

    private $capsuleService;

    public function __construct(CapsuleService $capsuleService)
    {   
        $this->capsuleService = $capsuleService;
    }

    /**
     * @OA\Get(
     *      path="/api/capsules",
     *      operationId="getCapsulesList",
     *      tags={"Capsules"},
     *      security={
     *         {"bearerAuth": {}}
     *      },
     *      @OA\Parameter(
     *      name="status",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *      ),
     *      summary="Get list of Capsules",
     *      description="Returns list of Capsules",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function getCapsules(Request $request){ // get all capsules and get capsules for status
        
        $data = $request->only([
            'status',
        ]);

       try{
        $result = $this->capsuleService->showCapsules($data);
        if($data){
            return response()->json([
                'status' => 200,
                'success_message' => 'Status=' . $request->status . ' Capsules list successfuly',
                'data' => $result,
            ], 200);
         }
         return response()->json([
            'status' => 200,
            'success_message' => 'All Capsules list successfuly',
            'data' => $result,
        ], 200);

        }catch(Exception $e){
            return response()->json([
                'status' => 400,
                'error' => 'Not found capsule',
                'success'=> false,
            ], 400);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/capsules/{capsule_serial}",
     *      operationId="getCapsulesList",
     *      tags={"Capsules Serial"},
     *      security={
     *         {"bearerAuth": {}}
     *      },
     *      @OA\Parameter(
     *      name="capsule_serial",
     *      in="path",
     *      @OA\Schema(
     *           type="string"
     *      )
     *      ),
     *      summary="Get list of Capsules",
     *      description="Returns list of Capsules",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function getCapsuleBySerial(Request $request){

        $data = $request->capsule_serial;
        try{
            $result = $this->capsuleService->showCapsuleInSerial($data);
            return response()->json([
                'status' => 200,
                'success_message' => 'Serial=' . $request->capsule_serial . ' Capsule list successfuly',
                'data' => $result,
            ], 200);

        }catch(Exception $e){
            return response()->json([
                'status' => 400,
                'error' => 'Not found capsule',
                'success'=> false,
            ], 400);
        }
    }

   
    # TODO : MAİL GONDERMEYİ ARASTİR
    # TODO : SendCommand'ta giriş yapan kullanıcı bilgilerini gonder Listeners/UserSendMail icinde,
        #  : bilgileri al ve giris yapan kullanicinin mail adresine e posta gonder
}
