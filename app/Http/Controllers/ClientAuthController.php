<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ClientAuthController extends Controller
{

    public function signup(Request $request){

        /* Response Array */
        $response = ["token"=>null, "user"=>null, "success"=>null, "message"=>null];

        /* Validate User Data */
        $rules = [
            "name" => "required | max:255 | string",
            "email" => "required | email | string | max:255 | unique:users",
            "password" => "required | string | min:8 | confirmed"
        ];

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()){
            $response["success"] = false;
            $response["message"] = "Validation Failed";
            return $validation->errors();
        }

        /* Add User to Database */
        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        $user = User::create($input);

        /* Create Token */
        $token = $user->createToken($user->email);
        $response["token"] = $token->plainTextToken;
        $response["user"] = $user;
        $response["success"] = true;
        $response["message"] = "Signup Successful";
        return $response;
    }

    public function login(Request $request){

        /* Response Array */
        $response = ["token"=>null, "user"=>null, "success"=>null, "message"=>null];

        /* Validate User Data */
        $rules = [
            "email" => "required | email | string | max:255",
            "password" => "required | string | min:8"
        ];

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()){
            $response["success"] = false;
            $response["message"] = "Validation Failed";
            return $validation->errors();
        }

        $user = User::where("email", $request->email)->first();

        /* Match Email and Password */
        if(!$user || !Hash::check($request->password, $user->password)){
            $response["success"] = false;
            $response["message"] = "Email or password is incorrect";
            return $response;
        }

        /* Revoke Token */
        $user->tokens()->delete();

        /* Create Token */
        $token = $user->createToken($user->email);
        $response["token"] = $token->plainTextToken;
        $response["user"] = $user;
        $response["success"] = true;
        $response["message"] = "Login Successful";
        return $response;
    }

    public function forgot(Request $request){

        $response = ["token"=>null, "user"=>null, "success"=>null, "message"=>null];

        /* Validate User Data */
        $rules = [
            "otp" => "required | numeric | min:6",
            "email" => "required | email | string | max:255",
            "password" => "required | string | min:8 | confirmed"
        ];

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()){
            $response["success"] = false;
            $response["message"] = "Validation Failed";
            return $validation->errors();
        }

        /* Get User */
        $user = User::where("email", $request->email)->first();

        /* Match Email */
        if(!$user){
            $response["success"] = false;
            $response["message"] = "Email does not exists";
            return $response;
        }

        /* Update User Password */
        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        $user->update(["password" => $input["password"]]);

        /* Revoke Token */
        $user->tokens()->delete();

        /* Create Token */
        $token = $user->createToken($user->email);
        $response["token"] = $token->plainTextToken;
        $response["user"] = $user;
        $response["success"] = true;
        $response["message"] = "Password Reseted Successful";
        return $response;

        return ["message"=>"Forgot Working"];
    }

    public function setotp(Request $request){

        /* Response Array */
        $response = ["success"=>null, "message"=>null];

        /* Validate User Data */
        $rules = [
            "email" => "required | email | string | max:255",
        ];

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()){
            $response["success"] = false;
            $response["message"] = "Validation Failed";
            return $validation->errors();
        }

        /* Get User */
        $user = User::where("email", $request->email)->first();

        /* Match Email */
        if(!$user){
            $response["success"] = false;
            $response["message"] = "Email does not exists";
            return $response;
        }

        /* Update OTP */
        $otp = mt_rand(100000, 999999);
        $user->update(["otp"=>$otp]);
        $response["success"] = true;
        $response["message"] = "OTP sent to your email address";
        return $response;
    }

    public function loginerr(){
        $response["success"] = false;
        $response["message"] = "You do not have permission to access the page";
        return $response;
    }
}