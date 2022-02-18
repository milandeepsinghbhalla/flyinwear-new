<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user_controller;
use App\Http\Controllers\productcontroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('add-user',[user_controller::class,'add_user']);
Route::post('add-admin',[user_controller::class,'add_admin']);
Route::post('add-vendor',[user_controller::class,'add_vendor']);
Route::post('remove-admin',[user_controller::class,'remove_admin']);
Route::post('remove-vendor',[user_controller::class,'remove_vendor']);
Route::post('add-product-clothing',[productcontroller::class,'add_product_clothing']);

