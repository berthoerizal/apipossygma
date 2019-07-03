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

$router->group(['prefix' => 'admin'], function () use ($router) {
    $router->get('/v1/tconfuser', 'TconfusersApi@getTconfuser');
    $router->post('/v1/users/add', 'UsersApi@store');
    $router->post('/v1/login', 'UsersApi@login');
});
