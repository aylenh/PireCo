<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistribuidorController;
use App\Http\Controllers\EncargoController;
use App\Http\Controllers\HRImporterController;
use App\Http\Controllers\InconsistencieController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\ResumenBidones;
use App\Http\Controllers\SendinBlueController;
use App\Http\Controllers\TerminosController;
use Illuminate\Http\Request;

//RUTAS DE CAJA

Route::resource('/caja', 'CashController');
Route::post('/caja-egreso', 'CashController@Crearegreso')->name('crear.egreso');

Route::get('/cash_render/{day?}', 'CashController@render')->name('cash.render');
Route::get('/cash_add/income', 'CashController@addincome')->name('cash.addincome');
Route::get('/cash_add/outcome', 'CashController@addoutcome')->name('cash.addoutcome');
Route::get('/resumenCaja',    'CashController@resumencaja')->name('resumen.caja');
Route::post('/FiltrarCaja',    'CashController@resumencajaFiltro')->name('resumencaja.filtro');
Route::get('/PoliticasPrivacidad',    'TerminosController@index');


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

Route::get('/CajaBidones',    'ResumenBidones@index')->name('bidones.caja');
Route::get('/ResumenBidones',    'ResumenBidones@verResumenCaja')->name('bidonesG.resumen');

// RUTAS RESUMEN BIDONES hry
Route::post('/Bidones-devueltos', 'ResumenBidones@bidonesgenerados')->name('bidones.resumen');
Route::post('/Inventario-bidones', 'ResumenBidones@devolucionBidones')->name('inventario.bidones');
Route::post('/ResumenBidones-dia', 'ResumenBidones@resumenBidones')->name('bidones.dia');
Route::get('/ResumenBidones-todos', 'ResumenBidones@resumenTodos')->name('bidones.todos');
Route::post('/Bidones-filtrar', 'ResumenBidones@BidonesCajaFiltro')->name('bidones.caja.filtrar');
Route::get('/Todos', 'ResumenBidones@verTodo')->name('vertodo.cajaBidones');


//RUTAS DE DISTRIBUIDORES
Route::post('/saveDistribuidor', 'DistribuidorController@save')->name('save.distribuidor');
Route::post('/updateDistribuidor', 'DistribuidorController@updateDistribuidor')->name('update.distribuidor');
Route::post('/deleteDistribuidor', 'DistribuidorController@deleteDistribuidor')->name('delete.distribuidor');
Route::get('/fetchDistribuidores', 'DistribuidorController@fetchDistribuidores')->name('fetch.distribuidores');
Route::get('/getDistribuidoresDetails', 'DistribuidorController@getDistribuidoresDetails')->name('get.distribuidores.details');

//RUTAS DE PRODUCTOS
Route::post('/saveProducto', 'ProductoController@guardar')->name('save.producto');
Route::get('/mostrarProductos', 'ProductoController@mostrarProductos')->name('mostrar.productos');
Route::post('/editarProducto', 'ProductoController@editarProducto')->name('editar.producto');
Route::post('/ActualizarProducto', 'ProductoController@actualizarProducto')->name('actualizar.producto');
Route::post('/borrarProductos', 'ProductoController@borrarProductosCheck')->name('borrar.producto.check');
Route::post('/borrarProducto', 'ProductoController@borrarProducto')->name('borrar.producto');


//RUTAS ENCARGOS

Route::get('Encargos','EncargoController@index')->name('encargos');
Route::get('/encargo/{encargo}/ver','EncargoController@detallesEncargo')->name('detalles.encargo');

// Route::get('/correo', function () {
//     return view('correos.pedidos');
// });
Route::view('/correo', 'correos.pedidos');
Route::view('/', 'auth.log');
Route::view('/admin', 'layouts.admin');
Route::view('/distribuidores', 'distribuidores.register');
Route::view('/productos', 'productos.agua');
Route::view('/login', 'auth.log');
Route::view('/', 'auth.log');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
