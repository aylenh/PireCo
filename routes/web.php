<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.log');
});

Route::get('/admin', function () {
    return view('layouts.admin');
});

Route::get('/login', function () {
    return view('auth.log');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
