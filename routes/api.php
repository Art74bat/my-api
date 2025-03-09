<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\Price\CorporatePriceController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\Price\HardWarePriceController;
use App\Http\Controllers\ManufacturerController;
// use App\Http\Controllers\PostBodyController;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\Price\RecoveryPriceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Price\SettingLinePriceController;
use App\Http\Controllers\Price\SoftWarePriceController;
use App\Http\Controllers\Price\SubscriptionPriceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// profile
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Posts
Route::apiResource('posts',PostController::class);

// User
Route::controller(AuthController::class)->group(function (){
    Route::get('/users',[AuthController::class,'index'])->middleware('auth:sanctum');
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::get('/user',[AuthController::class,'show'])->middleware('auth:sanctum');
    Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
    Route::put('/update/{user}',[AuthController::class,'update'])->middleware('auth:sanctum');
    Route::delete('/destroy/{user}',[AuthController::class,'destroy'])->middleware('auth:sanctum');
});
// Calls
Route::controller(CallController::class)->group(function (){
    Route::get('/calls',[CallController::class,'index']);
    // Route::get('/calls/{call}',[CallController::class,'show']);
    Route::post('/calls',[CallController::class,'store']);
    Route::delete('/calls/{call}',[CallController::class,'destroy'])->middleware('auth:sanctum');
});

// Reviews
Route::controller(ReviewController::class)->group(function (){
    Route::get('/reviews',[ReviewController::class,'index']);
    // Route::get('/reviews/{review}',[ReviewController::class,'show']);
    Route::post('/reviews',[ReviewController::class,'store']);
    Route::delete('/reviews/{review}',[ReviewController::class,'destroy'])->middleware('auth:sanctum');
});


// Device
Route::controller(DeviceController::class)->group(function (){
    Route::get('/devices',[DeviceController::class,'index']);
    // Route::get('/devices/{device}',[DeviceController::class,'show']);
    Route::post('/devices',[DeviceController::class,'store'])->middleware('auth:sanctum');
    Route::delete('/devices/{device}',[DeviceController::class,'destroy'])->middleware('auth:sanctum');
});


// Manufacturers
Route::controller(ManufacturerController::class)->group(function (){
    Route::get('/manufacturers',[ManufacturerController::class,'index']);
    // Route::get('/manufacturers/{manufacturer}',[ManufacturerController::class,'show']);
    Route::post('/manufacturers',[ManufacturerController::class,'store'])->middleware('auth:sanctum');
    Route::delete('/manufacturers/{manufacturer}',[ManufacturerController::class,'destroy'])->middleware('auth:sanctum');
});

// image
Route::controller(PostImageController::class)->group(function (){
    Route::get('/images',[PostImageController::class,'index']);
    Route::post('/images/{image}',[PostImageController::class,'update']);
});

// PostBody
// Route::controller(PostBodyController::class)->group(function (){
//     // Route::get('/images',[PostBodyController::class,'index']);
//     Route::post('/bodies',[PostBodyController::class,'create']);
//     Route::put('/bodies/{body}',[PostBodyController::class,'update']);
// });



// ----------------------PriceList--------------




// HardWarePrice--------------------------------------------------------
Route::controller(HardWarePriceController::class)->group(function (){
    Route::get('/hards',[HardWarePriceController::class,'index']);
    Route::post('/hards',[HardWarePriceController::class,'store'])->middleware('auth:sanctum');
    Route::put('/hards/{hard}',[HardWarePriceController::class,'update'])->middleware('auth:sanctum');
    Route::patch('/hards/{hard}',[HardWarePriceController::class,'update'])->middleware('auth:sanctum');
    Route::delete('/hards/{hard}',[HardWarePriceController::class,'destroy'])->middleware('auth:sanctum');
});

// SoftWarePrice
Route::controller(SoftWarePriceController::class)->group(function (){
    Route::get('/softs',[SoftWarePriceController::class,'index']);
    Route::post('/softs',[SoftWarePriceController::class,'store'])->middleware('auth:sanctum');
    Route::put('/softs/{soft}',[SoftWarePriceController::class,'update'])->middleware('auth:sanctum');
    Route::patch('/softs/{soft}',[SoftWarePriceController::class,'update'])->middleware('auth:sanctum');
    Route::delete('/softs/{soft}',[SoftWarePriceController::class,'destroy'])->middleware('auth:sanctum');
});

// SettingLinePrice
Route::controller(SettingLinePriceController::class)->group(function (){
    Route::get('/settings',[SettingLinePriceController::class,'index']);
    Route::post('/settings',[SettingLinePriceController::class,'store'])->middleware('auth:sanctum');
    Route::put('/settings/{line}',[SettingLinePriceController::class,'update'])->middleware('auth:sanctum');
    Route::patch('/settings/{line}',[SettingLinePriceController::class,'update'])->middleware('auth:sanctum');
    Route::delete('/settings/{line}',[SettingLinePriceController::class,'destroy'])->middleware('auth:sanctum');
});


// RecoveryPrice
Route::controller(RecoveryPriceController::class)->group(function (){
    Route::get('/recoverys',[RecoveryPriceController::class,'index']);
    Route::post('/recoverys',[RecoveryPriceController::class,'store'])->middleware('auth:sanctum');
    Route::put('/recoverys/{recovery}',[RecoveryPriceController::class,'update'])->middleware('auth:sanctum');
    Route::patch('/recoverys/{recovery}',[RecoveryPriceController::class,'update'])->middleware('auth:sanctum');
    Route::delete('/recoverys/{recovery}',[RecoveryPriceController::class,'destroy'])->middleware('auth:sanctum');
});


// SubscriptionPrice
Route::controller(SubscriptionPriceController::class)->group(function (){
    Route::get('/subscript',[SubscriptionPriceController::class,'index']);
    Route::post('/subscript',[SubscriptionPriceController::class,'store'])->middleware('auth:sanctum');
    Route::put('/subscript/{item}',[SubscriptionPriceController::class,'update'])->middleware('auth:sanctum');
    Route::patch('/subscript/{item}',[SubscriptionPriceController::class,'update'])->middleware('auth:sanctum');
    Route::delete('/subscript/{item}',[SubscriptionPriceController::class,'destroy'])->middleware('auth:sanctum');
});

// CorporatePrice
Route::controller(CorporatePriceController::class)->group(function (){
    Route::get('/corporate',[CorporatePriceController::class,'index']);
    Route::post('/corporate',[CorporatePriceController::class,'store'])->middleware('auth:sanctum');
    Route::put('/corporate/{item}',[CorporatePriceController::class,'update'])->middleware('auth:sanctum');
    Route::patch('/corporate/{item}',[CorporatePriceController::class,'update'])->middleware('auth:sanctum');
    Route::delete('/corporate/{item}',[CorporatePriceController::class,'destroy'])->middleware('auth:sanctum');
});
