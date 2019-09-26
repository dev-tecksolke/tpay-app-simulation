<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Make Requests
Route::group([
	'prefix' => 'tests',
], function () {
	Route::post('c2b', 'HomeController@c2b')->name('c2b');
	Route::post('b2c', 'HomeController@b2c')->name('b2c');
});

//logs
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

