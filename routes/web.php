<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistribuidorController;

//RUTAS DE DISTRIBUIDORES
Route::post('/save', 'DistribuidorController@save')->name('save.distribuidor');
Route::get('/fetchDistribuidores', 'DistribuidorController@fetchDistribuidores')->name('fetch.distribuidores');

Route::get('/', function () {
    return view('auth.log');
});

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
