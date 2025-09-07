<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



/* Authentication Routes */
Route::post("signup", [ClientAuthController::class, "signup"]);
Route::post("login", [ClientAuthController::class, "login"]);
Route::post("setotp", [ClientAuthController::class, "setotp"]);
Route::post("forgot", [ClientAuthController::class, "forgot"]);
Route::get("login", [ClientAuthController::class, "loginerr"])->name("login");

Route::group(["middleware"=>"auth:sanctum"], function(){

    /* All Sanctum Routes goes here */

    Route::get("test", function(){
        return ["name"=>"Sandeep Rathod", "Age"=>"40"];
    });

});