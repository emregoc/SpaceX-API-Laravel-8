<?php

use App\Http\Controllers\ApiCapsuleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/login', [UserController::class, 'login']); 
Route::post('/register', [UserController::class, 'store']);

//Route::get('/capsules', [ApiCapsuleController::class, 'getCapsules']);
//Route::get('/capsules/{capsule_serial}', [ApiCapsuleController::class, 'getCapsuleBySerial']);

Route::middleware('auth:api')->group(function(){
    Route::get('/capsules', [ApiCapsuleController::class, 'getCapsules']);
    Route::get('/capsules/{capsule_serial}', [ApiCapsuleController::class, 'getCapsuleBySerial']);

    //Route::get('/user-data', [ApiCapsuleController::class, 'getUserData'])->name('user.data');

    Route::get('/logout', [UserController::class, 'logout']); 
});