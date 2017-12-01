<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$router->post('/login', 'Auth\LoginController@login');
$router->post('/login/refresh', 'Auth\LoginController@refresh');
$router->post('/logout', 'Auth\LoginController@logout');


Route::group(['middleware' => 'auth:api'], function(){
    Route::post('get-details', 'Auth\LoginController@login');
});