<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appliance;
use Illuminate\Support\Facades\Validator;

class ApplianceController extends Controller
{
    public function appliances(Request $request){}

    public function add(Request $request){

        /* Response Array */
        $response = ["message"=>null, "success"=>null, "data"=>null];

        /* Validate the Request */
        $rules = [
            "appliance_name" => "required",
            "appliance_type" => "required",
            "place_id" => "required",
            "room_id" => "required",
        ];

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()){
            $response["success"] = false;
            $response["message"] = "Validation Failed";
            return $validation->errors();
        }

        /* Get user from Sanctum */
        $user = $request->user();

        /* Add Appliance Under User */
        $appliance = $user->appliances()->create($request->all());
        $response["success"] = true;
        $response["message"] = "Appliance Added";
        $response["data"] = $appliance;

        /* Return the Response */
        return $response;
    }

    public function update(Request $request){
        /* Response Array */
        $response = ["message"=>null, "success"=>null, "data"=>null];

        /* Validate the Request */
        $rules = [
            "appliance_name" => "required",
            "appliance_type" => "required",
            "id" => "required",
        ];

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()){
            $response["success"] = false;
            $response["message"] = "Validation Failed";
            return $validation->errors();
        }

        /* Get Place by its id */
        $appliance = Appliance::find($request->id);

        /* Update Place Data */
        $appliance->update($request->all());
        $response["success"] = true;
        $response["message"] = "Appliance Updated";
        $response["data"] = $appliance;

        /* Return the Response */
        return $response;
    }

    public function delete(Request $request){
        $appliance = Appliance::find($request->id);

        /* Share Appliances Delete */
        $appliance->share_appliances()->delete();

        /* Timers Deleted */
        $appliance->timers()->delete();

        /* Delete Place */
        $appliance->delete();

        /* Response Array */
        $response = ["message"=>"Place Deleted", "success"=>true];

        return $response;
    }
}
