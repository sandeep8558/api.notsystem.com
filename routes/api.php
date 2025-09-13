<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ApplianceController;

Route::get("user", [ClientAuthController::class, "user"])->middleware('auth:sanctum');

/* Authentication Routes */
Route::post("signup", [ClientAuthController::class, "signup"]);
Route::post("login", [ClientAuthController::class, "login"]);
Route::post("setotp", [ClientAuthController::class, "setotp"]);
Route::post("forgot", [ClientAuthController::class, "forgot"]);
Route::get("login", [ClientAuthController::class, "loginerr"])->name("login");

Route::group(["middleware"=>"auth:sanctum"], function(){

    /* Places Routes */
    Route::get("places", [PlaceController::class, "places"]);
    Route::post("places/add", [PlaceController::class, "add"]);
    Route::post("places/update", [PlaceController::class, "update"]);
    Route::delete("places/delete", [PlaceController::class, "delete"]);

    /* Room Routes */
    Route::get("rooms", [RoomController::class, "rooms"]);
    Route::post("rooms/add", [RoomController::class, "add"]);
    Route::post("rooms/update", [RoomController::class, "update"]);
    Route::delete("rooms/delete", [RoomController::class, "delete"]);

     /* Appliance Routes */
    Route::get("appliances", [ApplianceController::class, "appliances"]);
    Route::post("appliances/add", [ApplianceController::class, "add"]);
    Route::post("appliances/update", [ApplianceController::class, "update"]);
    Route::delete("appliances/delete", [ApplianceController::class, "delete"]);

});