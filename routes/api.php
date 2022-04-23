<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user_controller;
use App\Http\Controllers\productcontroller;
use App\Http\Controllers\shiprocketController;
use App\Http\Controllers\vendorController;
use App\Http\Controllers\shippingController;
use App\Http\Controllers\mailController;

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
Route::post('get-stock',[productcontroller::class,'get_stock']);
Route::post('edit-stock',[productcontroller::class,'edit_stock']);


Route::get('get-all-products',[productcontroller::class,'get_all_products']);

Route::get('get-tocken-ship',[shiprocketController::class,'get_tocken_ship']);

Route::get('get-ship-tocken',[shiprocketController::class,'get_tocken']);
Route::post('add-ship-tocken',[shiprocketController::class,'add_tocken']);
Route::post('register-vendor',[vendorController::class,'add_vendor']);
Route::post('update-address-book',[user_controller::class,'update_address_book']);
Route::post('get-address-book',[user_controller::class,'get_address_book']);
Route::post('get-distances',[shippingController::class,'get_distances']);
Route::post('update-user-order',[user_controller::class,'update_user_order']);
Route::post('get-user-orders',[user_controller::class,'get_user_orders']);

Route::post('update-vendor-order',[vendorController::class,'update_vendor_order']);
Route::post('get-vendor-orders',[vendorController::class,'get_vendor_orders']);
Route::post('edit-order-stock',[productcontroller::class,'edit_order_stock']);
Route::post('send-order-mail',[mailController::class,'send_order_mail']);





