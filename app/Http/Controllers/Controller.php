<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


 /**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Spacex API",
 *      description="Auth and Spacex API operations",
 * ),
 *
 *
* @OA\SecurityScheme(
*      securityScheme="bearerAuth",
*      in="header",
*      name="oauth2",
*      type="http",
*      scheme="bearer",
*      bearerFormat="JWT",
*  )
*/

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
