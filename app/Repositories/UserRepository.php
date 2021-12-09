<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{

    /**
     * @var User
     */
    protected $user;

    /**
     * 
     * @param User $user;
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register($data){
        // first method
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_admin' => 0,
        ]);

        $token = $user->createToken('register_token')->accessToken;

        return [
            "data" => $user,
            "token" => $token,
        ];
       /* //second method
        $user = new User();
        // or
        $user = new $this->user();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        return $user->fresh();*/

    }

    public function login($user){
        $token = $user->createToken('register_token')->accessToken;
        
        return [
            "data" => $user,
            "token" => $token,
        ];
    }

}

?>