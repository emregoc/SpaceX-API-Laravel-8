<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    private $userService;

    public function __construct(UserService $userService)
    {   
        $this->userService = $userService;
    }

    /**
     * @OA\Post(
     ** path="/api/register",
     *   tags={"User"},
     *   summary="Register",
     *   operationId="register",
     *
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="password_confirmation",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
        ]);

        try{
            $result = $this->userService->userRegister($data);

            return response()->json([
                'status' => 200,
                'data' => $result['data'],
                'success'=> true,
                'token' => $result['token'],
            ], 200);

        }catch(Exception $e){
            return response()->json([
                'status' => 400,
                'error' => $e->getMessage(),
                'success'=> false,
            ], 400);
        }
    }


     /**
        * @OA\Post(
        * path="/api/login",
        * operationId="authLogin",
        * tags={"User"},
        * summary="User Login",
        * description="Login User Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"email", "password"},
        *               @OA\Property(property="email", type="email"),
        *               @OA\Property(property="password", type="password")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=201,
        *          description="Login Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=200,
        *          description="Login Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function login(Request $request){
        $data = $request->only([
            'email',
            'password',
        ]);

        try{
            $result = $this->userService->userLogin($data);

            return response()->json([
                'status' => 200,
                'data' => $result['data'],
                'success'=> true,
                'token' => $result['token'],
            ], 200);

        }catch(Exception $e){
            return response()->json([
                'status' => 400,
                'error' => 'User login failed',
                'success'=> false,
            ], 400);
        }
    }


         /**
        * @OA\Get(
        * path="/api/logout",
        * operationId="authLogout",
        * tags={"User Logout"},
        * security={
        *   {"bearerAuth": {}}
        * },
        * summary="User logout",
        * description="logout User Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="Application/json",
        *        ),
        *    ),
        *      @OA\Response(
        *          response=201,
        *          description="logout Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=200,
        *          description="logout Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function logout(){
        if(Auth::check()){ // check ile kullanicinin giris yapip yapmadigi kontrol edilir
            Auth::user()->token()->revoke();
           
            return response()->json([
                'success' => 'Successfully logged out'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
