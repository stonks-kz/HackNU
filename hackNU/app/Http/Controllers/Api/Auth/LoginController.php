<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
        if(isset($request["data"])){
            $credentials["email"] = $request["data"]["email"];
            $credentials["password"] = $request["data"]["password"];
        }
        else{
            $credentials["email"] = $request["email"];
            $credentials["password"] = $request["password"];
        }
//        $credentials = $request->only(['email', 'password']);
        if(!$token = auth()->attempt($credentials)){
            return response()->json(['error' => true, 'message' => 'Incorrect Login/Password'], 401);
        }
        $user = User::where("email" , "=", $request["email"])->get();
        return $user;
    }
}
