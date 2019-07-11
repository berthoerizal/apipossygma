<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->get('/tconfuser', 'TconfusersController@getTconfuser');
    $router->get('/users', 'UsersController@getUsers');
    $router->post('/users', 'UsersController@store');
    $router->post('/login', 'UsersController@login');
    $router->get('/entitas', 'EntitasController@getEntitas');
    $router->delete('/users/{id}', 'UsersController@destroy');
    $router->patch('/users/{userid}', 'UsersController@updateUser');
    $router->get('/location', 'LocationController@getLocation');
    $router->get('/produk', 'ProdukController@getProduk');
    $router->get('/konfigurasi', 'KonfigurasiController@getKonfigurasi');
    $router->post('/konfigurasi', 'KonfigurasiController@addKonfigurasi');
    $router->delete('/konfigurasi/{id}', 'KonfigurasiController@deleteKonfigurasi');
    $router->patch('/konfigurasi/{id}', 'KonfigurasiController@updateKonfigurasi');
    $router->get('/outlet', 'OutletController@getOutlet');
    $router->post('/outlet', 'OutletController@addOutlet');
    $router->delete('/outlet/{id}', 'OutletController@deleteOutlet');
    $router->patch('/outlet/{id}', 'OutletController@updateOutlet');
    $router->post('/image/{pt_id}', 'ImageController@updateImage');
    $router->get('/voucher/{id}', 'VoucherController@detail');
    $router->post('/voucher', 'VoucherController@store');
    $router->patch('/voucher/{id}', 'VoucherController@update');
    $router->delete('/voucher/{id}', 'VoucherController@destroy');
    $router->get('/shift', 'ShiftController@getShift');
    $router->post('/shift', 'ShiftController@addShift');
    $router->delete('/shift/{id}', 'ShiftController@deleteShift');
    $router->patch('/shift/{id}', 'ShiftController@updateShift');
    $router->post('/transaksi', 'TransaksiController@addTransaksi');
});
