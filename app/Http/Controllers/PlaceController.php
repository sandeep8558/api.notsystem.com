<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use Illuminate\Support\Facades\Validator;

class PlaceController extends Controller
{

    public function places(Request $request){
        $user = $request->user();
        return $user->places()
        ->with(["rooms.share_rooms"])
        ->with("rooms", function($rooms){
            $rooms->with('appliances');
        })
        ->with(["machines"])
        ->with(["appliances.timers"])
        ->with(["appliances.share_appliances"])
        ->with(["share_places"])
        ->get();
    }

    public function add(Request $request){

        /* Response Array */
        $response = ["message"=>null, "success"=>null, "data"=>null];

        /* Validate the Request */
        $rules = [
            "place_name" => "required",
            "address" => "required",
            "ssid" => "required",
            "pswd" => "required"
        ];

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()){
            $response["success"] = false;
            $response["message"] = "Validation Failed";
            return $validation->errors();
        }

        /* Get user from Sanctum */
        $user = $request->user();

        /* Add Place Under User */
        $place = $user->places()->create($request->all());
        $response["success"] = true;
        $response["message"] = "Place Added";
        $response["data"] = $place;

        /* Return the Response */
        return $response;
    }

    public function update(Request $request){

        /* Response Array */
        $response = ["message"=>null, "success"=>null, "data"=>null];

        /* Validate the Request */
        $rules = [
            "place_name" => "required",
            "address" => "required",
            "ssid" => "required",
            "pswd" => "required",
            "id" => "required",
        ];

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()){
            $response["success"] = false;
            $response["message"] = "Validation Failed";
            return $validation->errors();
        }

        /* Get Place by its id */
        $place = Place::find($request->id);

        /* Update Place Data */
        $place->update($request->all());
        $response["success"] = true;
        $response["message"] = "Place Updated";
        $response["data"] = $place;

        /* Return the Response */
        return $response;
    }

    public function delete(Request $request){

        $place = Place::find($request->id);

        /* ShareRoom Deleted */
        foreach($place->rooms() as $room){
            $room->share_rooms()->delete();
        }

        /* Rooms Deleted */
        $place->rooms()->delete();
        
        /* Machines Deleted */
        $place->machines()->delete();

        /* ShareAppliance Deleted */
        foreach($place->appliances() as $appliance){
            $appliance->share_appliances()->delete();
        }

        /* Timers Deleted */
        foreach($place->appliances() as $appliance){
            $appliance->timers()->delete();
        }

        /* Appliances Deleted */
        $place->appliances()->delete();

        /* SharePlace Deleted */
        $place->share_places()->delete();

        /* Delete Place */
        $place->delete();

        /* Response Array */
        $response = ["message"=>"Place Deleted", "success"=>true];

        return $response;
    }

}