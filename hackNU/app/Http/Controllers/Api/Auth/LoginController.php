<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use stdClass;

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
    public function registration(Request $request){
        $rules = [
            'name' => 'required|min:2',
            'email' => 'required|email|unique',
            'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            'password_confirm' => 'required|same:password'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator){
            User::insert([
                "name" => $request->name,
                "password" => bcrypt($request->password),
                "email" => $request->email,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            $result = User::where("email", "=", $request["email"])->get();
            return $result;
        }
        else{
            return response()->json(["error"=> true]);
        }
    }

    public function profileChange(Request $request) {
        $rules = [
            'name' => 'required|min:2',
            'age' => 'numeric',
            'gender' => 'max:4'
        ];
        $request["updated_at"] = Carbon::now()->format('Y-m-d H:i:s');
        $validator = Validator::make($request->all(), $rules);

        User::where("email", "=", $request->email)->update($request->all());

        if($validator){
            $result = User::where("email", "=", $request["email"])->get();
            return $result;
        }
        else{
            return response()->json(["error" => true]);
        }
    }
}
