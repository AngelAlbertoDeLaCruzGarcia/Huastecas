<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum', 'verified')->get('/user', function (Request $request) {
    return $request->user();
});
///Login 
Route::post('/checkuser', 'App\Http\Controllers\reactControllerUser@checkUser');
Route::post('/sendverify', 'App\Http\Controllers\reactControllerUser@sendVerify');
Route::post('/verifycelular', 'App\Http\Controllers\reactControllerUser@verifycelular');

///Update User
Route::post('/usuario', 'App\Http\Controllers\reactControllerUser@ReactUser');
Route::post('/usuarioShow', 'App\Http\Controllers\reactControllerUser@show');

////Products and buy
Route::get('/products', 'App\Http\Controllers\ProductControllerApi@index');
Route::get('/products/{idprod}', 'App\Http\Controllers\ProductControllerApi@show');
Route::post('/product', 'App\Http\Controllers\ProductControllerApi@buscarProd');
Route::post('/orders', 'App\Http\Controllers\OrdersControllerApi@Orders');
Route::get('/orders', 'App\Http\Controllers\OrdersControllerApi@index');
Route::get('/order', 'App\Http\Controllers\OrdersControllerApi@order');

///Facturacion
Route::post('/invoice', 'App\Http\Controllers\InvoiceController@facturar');
Route::get('/invoice', 'App\Http\Controllers\InvoiceController@show');
Route::get('/invoice2', 'App\Http\Controllers\InvoiceController@index2');

///Notifications
Route::get('/noti', 'App\Http\Controllers\NotificationControllerApi@index2');
Route::post('/notifications', 'App\Http\Controllers\NotificationControllerApi@index');
Route::post('/add/notifications', 'App\Http\Controllers\NotificationControllerApi@store');
Route::post('/del/notifications/{idnoti}', 'App\Http\Controllers\NotificationControllerApi@delete');
