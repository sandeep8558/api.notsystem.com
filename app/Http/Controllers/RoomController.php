<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function rooms(Request $request){
        $user = $request->user();
        return $user->rooms()
        ->where("place_id", $request->place_id)
        ->with(["share_rooms"])
        ->with(["machines"])
        ->with(["appliances.timers"])
        ->with(["appliances.share_appliances"])
        ->get();
    }

    public function add(Request $request){
        /* Response Array */
        $response = ["message"=>null, "success"=>null, "data"=>null];

        /* Validate the Request */
        $rules = [
            "room_name" => "required",
            "place_id" => "required",
        ];

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()){
            $response["success"] = false;
            $response["message"] = "Validation Failed";
            return $validation->errors();
        }

        /* Get user from Sanctum */
        $user = $request->user();
        $place_id = $request->place_id;

        /* Add Place Under User */
        $place = $user->rooms()->create($request->all());
        $response["success"] = true;
        $response["message"] = "Room Added";
        $response["data"] = $place;

        /* Return the Response */
        return $response;
    }

    public function update(Request $request){
        /* Response Array */
        $response = ["message"=>null, "success"=>null, "data"=>null];

        /* Validate the Request */
        $rules = [
            "room_name" => "required",
            "id" => "required",
        ];

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()){
            $response["success"] = false;
            $response["message"] = "Validation Failed";
            return $validation->errors();
        }

        /* Get Place by its id */
        $place = Room::find($request->id);

        /* Update Place Data */
        $place->update($request->all());
        $response["success"] = true;
        $response["message"] = "Room Updated";
        $response["data"] = $place;

        /* Return the Response */
        return $response;
    }

    public function delete(Request $request){
        $room = Room::find($request->id);
        
        /* Machines Deleted */
        $room->machines()->delete();

        /* ShareAppliance Deleted */
        foreach($room->appliances() as $appliance){
            $appliance->share_appliances()->delete();
        }

        /* Timers Deleted */
        foreach($room->appliances() as $appliance){
            $appliance->timers()->delete();
        }

        /* Appliances Deleted */
        $room->appliances()->delete();

        /* SharePlace Deleted */
        $room->share_rooms()->delete();

        /* Delete Place */
        $room->delete();

        /* Response Array */
        $response = ["message"=>"Place Deleted", "success"=>true];

        return $response;
    }
}
