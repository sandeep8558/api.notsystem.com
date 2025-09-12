<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\PlaceController;

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

    /* All Sanctum Routes goes here */

    Route::get("test", function(){
        return ["name"=>"Sandeep Rathod", "Age"=>"40"];
    });

});