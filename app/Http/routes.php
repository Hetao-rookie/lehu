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

$app->get('/', function () use ($app) {
    return "LEHU 1.0";
});


$app->group(['prefix' => 'api','middleware'=>'auth', 'namespace' => '\App\Http\Controllers'], function () use ($app) {

    $app->post('login', 'AuthController@login');
    $app->post('register', 'AuthController@register');

    $app->get('users', 'UserController@get');

    $app->get('system/install','SystemController@install');

});
