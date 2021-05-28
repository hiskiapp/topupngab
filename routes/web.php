<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Auth::routes(['register' => false, 'verify' => true]);

Route::group(['middleware' => 'auth', 'verified'], function() {
	Route::group(['prefix' => 'data', 'as' => 'data.'], function() {
		Route::post('logs', 'DataController@logs')->name('logs');
		Route::post('customers', 'DataController@customers')->name('customers');
		Route::post('games', 'DataController@games')->name('games');
		Route::post('items', 'DataController@items')->name('items');
		Route::post('broadcasts', 'DataController@broadcasts')->name('broadcasts');
		Route::post('schedules', 'DataController@schedules')->name('schedules');
		Route::post('settings', 'DataController@settings')->name('settings');
		Route::post('transactions', 'DataController@transactions')->name('transactions');
		Route::post('users', 'DataController@users')->name('users');
	});
	
	Route::get('/', 'HomeController@index')->name('home');

	Route::group(['prefix' => 'bot', 'as' => 'bot.'], function() {
		Route::get('/', 'BotController@index')->name('index');
		Route::patch('token', 'BotController@token')->name('token');
	});

	Route::group(['prefix' => 'transactions', 'as' => 'transactions.'], function() {
		Route::get('/', 'TransactionController@index')->name('index');
		Route::get('{id}', 'TransactionController@show')->name('show');
		Route::patch('{id}', 'TransactionController@approval')->name('approval');
	});

	Route::resource('report', 'ReportController')->only(['index']);
	
	Route::resource('users', 'UserController');

	Route::resource('customers', 'CustomerController')->only(['index', 'show']);

	Route::resource('games', 'GameController');

	Route::resource('broadcast', 'BroadcastController')->only(['index', 'store']);

	Route::resource('schedules', 'ScheduleController')->except(['show']);

	Route::resource('settings', 'SettingController')->only(['index', 'update']);
});
