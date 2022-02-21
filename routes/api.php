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
Route::post('login-user',[user_controller::class,'login_user']);
Route::post('update-cart',[user_controller::class,'update_cart']);
Route::post('get-wishlist',[user_controller::class,'get_wishlist']);
Route::post('update-wishlist',[user_controller::class,'update_wishlist']);

Route::post('add-admin',[user_controller::class,'add_admin']);
Route::post('add-vendor',[user_controller::class,'add_vendor']);
Route::post('remove-admin',[user_controller::class,'remove_admin']);
Route::post('remove-vendor',[user_controller::class,'remove_vendor']);
Route::post('add-product-clothing',[productcontroller::class,'add_product_clothing']);
Route::post('add-product-other',[productcontroller::class,'add_product_other']);
Route::post('get-products',[productcontroller::class,'get_products']);
Route::get('get-all-products',[productcontroller::class,'get_all_products']);


