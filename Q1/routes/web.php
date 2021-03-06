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
    return redirect()->route('login');
});

// Login related routes
$router->get('login', [
    'as' => 'login', 
    'uses' => 'UserController@login'
]);
$router->post('login', [
    'uses' => 'UserController@validateLogin'
]);

// Register related routes
$router->get('register', [
    'as' => 'register', 
    'uses' => 'UserController@register'
]);
$router->post('register', [
    'uses' => 'UserController@store'
]);
