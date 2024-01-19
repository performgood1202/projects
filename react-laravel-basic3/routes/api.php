<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([ 'prefix' => 'v1' ], function ($router) {
	Route::get('info', 'Api\UserController@info');
	Route::prefix('auth')->group(function () {
		Route::post('login', 'Auth\LoginController@login');
	});
	// users authentication routes.
    Route::group(['middleware' => 'auth:api'], function ($router) {
		Route::get('auth/logout', 'Auth\LogoutController@logout');
		// all api folder routes.
		Route::namespace('Api')->group(function () {
			Route::get('dashboard', 'DashboardController@index');
		});
	});
});
