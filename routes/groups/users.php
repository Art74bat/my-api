<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::controller(UserController::class)->group(function(){
    Route::post('login','login')->name('login');
    Route::post("register", 'register')->name('register');

});
    Route::get("profile", [UserController::class, "profile"])->middleware('auth:sanctum');
    Route::get("logout", [UserController::class, "logout"])->middleware('auth:sanctum');
    Route::get("refresh-token", [UserController::class, "refreshToken"])->middleware('auth:sanctum');
// Route::group([
//     "middleware" => ["auth:sanctum"]
// ], function(){
    

// });
