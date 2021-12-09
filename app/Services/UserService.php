<?php 

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class UserService
{

    /**
     * @var $userRepository
     */
    protected $userRepository;

    /** UserService Constructor
     * 
     * @param UserRepository $userRepository;
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function userRegister($data){
        $validator = Validator::make($data, [ 
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            //'password' => 'required|min:8',
            'password' => 'required',
        ]);

        if ($validator->fails()) { // eger hata varsa hata dondurur yoksa diger isleme gecer
            throw new InvalidArgumentException($validator->errors());
        }
        
        $result = $this->userRepository->register($data);

        return $result;
    }

    public function userLogin($data){
        $email = $data['email'];
        $password = $data['password'];

        try{
            if(Auth::attempt(['email' => $email, 'password' => $password])) {
                $user = Auth::user();              
                $result = $this->userRepository->login($user);

                return $result;
            }

        }catch(Exception $e){
            $e->getMessage();
        }

       
    }
}

?>