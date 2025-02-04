<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get("", [UserController::class, "index"]);
Route::post("register", [UserController::class, "register"]);
Route::post("login", [UserController::class, "login"]);

// Protected Routes
Route::group([
    "middleware" => ["auth:sanctum"]
], function(){ 
    Route::get("profile", [UserController::class, "profile"]);
    Route::get("logout", [UserController::class, "logout"]);
    Route::get("refresh-token", [UserController::class, "refreshToken"]);
    Route::put("update-profile", [UserController::class, "update"]);
    Route::patch("update-profile", [UserController::class, "update"]);
});