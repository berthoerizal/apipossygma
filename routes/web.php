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
    $router->post('/users', 'UsersController@store');
    $router->post('/login', 'UsersController@login');
    $router->get('/entitas', 'EntitasController@entitas');
    $router->delete('/users/delete/{id}', 'UsersController@destroy');
    $router->get('/location', 'LocationController@getLocation');
    $router->get('/produk', 'ProdukController@getProduk');
    $router->get('/outlet', 'OutletController@getOulet');
});
