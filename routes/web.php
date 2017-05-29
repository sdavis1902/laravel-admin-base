<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect('dashboard');
});

MoreRoute::controller('auth', 'AuthController');

Route::group(['middleware' => ['authcheck', 'globalviewshare']], function () {
	MoreRoute::controller('dashboard', 'DashboardController');
	MoreRoute::controller('user', 'UserController');
});
