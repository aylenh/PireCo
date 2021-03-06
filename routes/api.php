<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Api Pedidos
Route::resource('getPedidos', 'PedidoController');
//Api Pedidos
Route::resource('getDistribuidores', 'ApiDistribuidorController');
//Api Payments MercadoPago
Route::resource('payments', 'PaymentController');
//Api EncargosApp
Route::resource('getEncargos', 'Api\EncargoController');
//Api Productos
Route::resource('productos', 'Api\ProductoController');
// Pagar en Efectivo
Route::post('pay_cash/{encargo}','Api\EncargoController@payCash');

// Route::prefix('mercadopago')->group(function(){

//     Route::post('notification', 'Api\MercadoPagoController@notification');
//     Route::post('success', function(){
//         return true;
//     });
//     Route::post('failure', function(){
//         return true;
//     });

// });

