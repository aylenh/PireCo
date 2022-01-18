<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistribuidorController;
use App\Http\Controllers\EncargoController;
use App\Http\Controllers\HRImporterController;
use App\Http\Controllers\InconsistencieController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\SendinBlueController;
use Illuminate\Http\Request;

//RUTAS DE CAJA

Route::resource('/caja', 'CashController');
Route::get('/cash_render/{day?}', 'CashController@render')->name('cash.render');
Route::get('/cash_add/income', 'CashController@addincome')->name('cash.addincome');
Route::get('/cash_add/outcome', 'CashController@addoutcome')->name('cash.addoutcome');

/* Operator's Cash module */
Route::resource('/cash2',    'Cash2Controller');
Route::get('/cash2_render/{day?}',    'Cash2Controller@render')->name('cash2.render');
Route::get('/cash2_add/income',    'Cash2Controller@addincome')->name('cash2.addincome');
Route::get('/cash2_add/outcome',    'Cash2Controller@addoutcome')->name('cash2.addoutcome');

Route::resource('/resumenmonthly',    'ResumenmonthlyController');
Route::get('/resumenmonthy_render/{day?}',    'ResumenmonthlyController@render')->name('resumenmonthly.render');
Route::get('/resumenmonthy_addrecibo',    'ResumenmonthlyController@addrecibo')->name('resumenmonthly.addrecibo');

Route::resource('/remitos',    'RemitosController');
Route::get('/remitos_render/{client}/{day?}',    'RemitosController@render')->name('remitos.render');

//RUTAS DE CAJA BOTELLA
Route::resource('/botellas', 'BotellaController');
Route::resource('/resumenbotellas',    'ResumenBidones');




//RUTAS DE DISTRIBUIDORES
Route::post('/saveDistribuidor', 'DistribuidorController@save')->name('save.distribuidor');
Route::post('/updateDistribuidor', 'DistribuidorController@updateDistribuidor')->name('update.distribuidor');
Route::post('/deleteDistribuidor', 'DistribuidorController@deleteDistribuidor')->name('delete.distribuidor');
Route::get('/fetchDistribuidores', 'DistribuidorController@fetchDistribuidores')->name('fetch.distribuidores');
Route::get('/getDistribuidoresDetails', 'DistribuidorController@getDistribuidoresDetails')->name('get.distribuidores.details');

//RUTAS DE PRODUCTOS
Route::post('/saveProducto', 'ProductoController@save')->name('save.producto');
Route::post('/updateProducto', 'ProductoController@updateProducto')->name('update.producto');
Route::post('/deleteProducto', 'ProductoController@deleteProducto')->name('delete.producto');
Route::get('/fetchProductos', 'ProductoController@fetchProductos')->name('fetch.productos');
Route::get('/getProductosDetails', 'ProductoController@getProductosDetails')->name('get.productos.details');

//RUTAS ENCARGOS

Route::get('Encargos','EncargoController@index')->name('encargos');
Route::get('/encargo/{encargo}/ver','EncargoController@detallesEncargo')->name('detalles.encargo');

Route::get('/correo', function () {
    return view('correos.pedidos');
});


Route::get('/', function () { return view('auth.log');});

Route::get('/admin', function () {
    return view('layouts.admin');
});

Route::get('/registro', function () {
    return view('auth.register');
});

Route::get('/distribuidores', function () {
    return view('distribuidores.register');
});

Route::get('/productos', function () {
    return view('productos.agua');
});

Route::get('/login', function () {
    return view('auth.log');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
