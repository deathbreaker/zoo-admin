<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Database\Hash;

use App\Controllers\RestApi;

class AuthController
{
    use RestApi;

    public function login( $email = null, $password = null)
    {

        try{
            if($email === null && $password === null){
                $email =  $this->getData()->email;
                $password =  $this->getData()->password;
            }

            $auth = User::where('email',   $email)->first();

            if (Hash::verify( $password , $auth->password)){
                 $this->sendSuccessLoginResponse($auth);
            }
            else{
                 $this->sendFailedLoginResponse();
            }

        }
        catch (\Exception $e){
             $this->sendFailedLoginResponse($e);
        }


    }

    public function sendSuccessLoginResponse($auth){
        session_start();
        $_SESSION["role"] = $auth->role;
        //return  $this->sendData([], 200);
        echo $_SESSION['user'];
    }

    public function sendFailedLoginResponse($e = "Error occured.")
    {
      return  $this->sendData($e, 500);
    }


    public function register():func
    {
        $user = new User();
        $user->email =  $this->getData()->email;
        $user->password = Hash::bcrypt( $this->getData()->password);
        $user->name =  $this->getData()->name;
        $user->age =  $this->getData()->age;
        $user->phonenumber = null;
        $user->role = "user";
        $user->save();
        return  $this->login(  $this->getData()->email,  $this->getData()->password);
    }

    public function logout()
    {
        session_start();
        session_destroy();
    }

    public function auth()
    {
        session_start();
        if (!empty($_SESSION['role']))
        {
            $role = $_SESSION["role"];
            return  $this->sendData(["auth" => $role], 200);
        }

        return  $this->sendData(["auth" => null], 403);

    }

}