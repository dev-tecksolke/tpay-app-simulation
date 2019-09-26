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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Deposits and withdraw callback
Route::group([
	'prefix' => 'callbacks',
	'namespace' => 'API',
], function () {
	Route::post('stk-callback', 'AppController@stkC2BCallBack')->name('stk.callback');
	Route::post('withdraw-callback', 'AppController@withdrawB2CCallBack')->name('withdraw.callback');
});
