<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistribuidorController;


use App\Http\Controllers\HRImporterController;
use App\Http\Controllers\InconsistencieController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\SendinBlueController;
use Illuminate\Http\Request;

//RUTAS DE CAJA
//Route::get('/', function () { return redirect('/dashboard'); });

Route::post('/login/superadmin/',  'LoginController@superAdmin')->name('superadmin');
Route::resource('/login',   'LoginController');
Route::resource('/dashboard',    'DashboardController');
Route::resource('/users',    'UsersController');
Route::resource('/clients',    'ClientsController');
Route::resource('/clientsbyservices',    'ClientsByServicesController');


Route::resource('/remitos',    'RemitosController');
    Route::get('/remitos_render/{client}/{day?}',    'RemitosController@render')->name('remitos.render');

Route::resource('/resumen',    'ResumenController');
    Route::get('/resumen_render/{day?}',    'ResumenController@render')->name('resumen.render');

Route::resource('/resumenmonthly',    'ResumenmonthlyController');
    Route::get('/resumenmonthy_render/{day?}',    'ResumenmonthlyController@render')->name('resumenmonthly.render');
    Route::get('/resumenmonthy_addrecibo',    'ResumenmonthlyController@addrecibo')->name('resumenmonthly.addrecibo');

Route::resource('/cashincome',    'CashIncome');
Route::resource('/cashoutcome',    'CashOutcome');

Route::resource('/cash',    'CashController');
Route::get('/cash_render/{day?}',    'CashController@render')->name('cash.render');
Route::get('/cash_add/income',    'CashController@addincome')->name('cash.addincome');
Route::get('/cash_add/outcome',    'CashController@addoutcome')->name('cash.addoutcome');

/* Operator's Cash module */
Route::resource('/cash2',    'Cash2Controller');
Route::get('/cash2_render/{day?}',    'Cash2Controller@render')->name('cash2.render');
Route::get('/cash2_add/income',    'Cash2Controller@addincome')->name('cash2.addincome');
Route::get('/cash2_add/outcome',    'Cash2Controller@addoutcome')->name('cash2.addoutcome');

/* Printing */
Route::resource('/remitosprint',    'RemitosprintController');
    Route::get('/remitosprint_render/{client}/{day}/{day2}',    'RemitosprintController@render')->name('remitosprint.render');


//RUTAS DE DISTRIBUIDORES
Route::post('/save', 'DistribuidorController@save')->name('save.distribuidor');
Route::post('/updateDistribuidor', 'DistribuidorController@updateDistribuidor')->name('update.distribuidor');
Route::post('/deleteDistribuidor', 'DistribuidorController@deleteDistribuidor')->name('delete.distribuidor');
Route::get('/fetchDistribuidores', 'DistribuidorController@fetchDistribuidores')->name('fetch.distribuidores');
Route::get('/getDistribuidoresDetails', 'DistribuidorController@getDistribuidoresDetails')->name('get.distribuidores.details');


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

Route::get('/login', function () {
    return view('auth.log');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
