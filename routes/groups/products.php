<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::controller(ProductController::class)
->prefix('products')
->group(function()
{
    Route::get('','index')->name('products.index');
    Route::get('{product}','show')->name('products.show')->middleware('draft');
    Route::post('','store')->name('products.store')->middleware(['auth:sanctum','admin']);
    Route::post('{product}/review','review')->name('products.review.store')->middleware(middleware: 'auth:sanctum');
    Route::put('{product}','update')->name('products.update')->middleware('auth:sanctum','admin');
    Route::patch('{product}','update')->name('products.update')->middleware('auth:sanctum','admin');
    Route::delete('{product}','destroy')->name('products.destroy')->middleware(['auth:sanctum','admin']);
});