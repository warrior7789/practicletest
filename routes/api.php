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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([
    'namespace'=>'App\Http\Controllers\Api',
    'prefix' => 'auth'
], function () {
    Route::post('login', 'ApiController@login');
    Route::post('signup', 'ApiController@signup');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'ApiController@logout');
        Route::get('user', 'ApiController@user');
    });
    
    
});

Route::group([
    'namespace'=>'App\Http\Controllers\Api'
], function () {
    Route::get('/categories', 'ApiController@categories');
    Route::get('/products/{category_id}', 'ApiController@ProductByCategory');
    Route::get('/searchproduct/{query}', 'ApiController@searchproduct');
    Route::get('/product/{id}', 'ApiController@getproduct');
});