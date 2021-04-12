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
		Route::post('customers', 'DataController@customers')->name('customers');
		Route::post('games', 'DataController@games')->name('games');
		Route::post('items', 'DataController@items')->name('items');
		Route::post('schedules', 'DataController@schedules')->name('schedules');
		Route::post('settings', 'DataController@settings')->name('settings');
		Route::post('transactions', 'DataController@transactions')->name('transactions');
		Route::post('users', 'DataController@users')->name('users');
	});
	
	Route::get('/', 'HomeController@index')->name('home');

	Route::resource('bot', 'BotController')->only(['index']);

	Route::group(['prefix' => 'transactions', 'as' => 'transactions.'], function() {
		Route::get('/', 'TransactionController@index')->name('index');
		Route::get('{id}', 'TransactionController@show')->name('show');
		Route::patch('{id}', 'TransactionController@approval')->name('approval');
	});

	Route::resource('report', 'ReportController')->only(['index']);
	
	Route::resource('users', 'UserController');

	Route::resource('customers', 'CustomerController')->only(['index', 'show']);

	Route::resource('games', 'GameController');

	Route::group(['as' => 'items.'], function() {
		Route::group(['prefix' => 'games/{game}/items',], function() {
			Route::get('/', 'ItemController@index')->name('index');
			Route::get('create', 'ItemController@create')->name('create');
			Route::post('store', 'ItemController@store')->name('store');
		});

		Route::group(['prefix' => 'items',], function() {
			Route::get('{id}', 'ItemController@show')->name('show');
			Route::get('{id}/edit', 'ItemController@edit')->name('edit');
			Route::patch('{id}', 'ItemController@update')->name('update');
			Route::delete('{id}', 'ItemController@destroy')->name('destroy');
		});
	});

	Route::resource('broadcast', 'BroadcastController')->only(['index', 'store']);

	Route::resource('schedules', 'ScheduleController')->except(['show']);

	Route::resource('settings', 'SettingController')->only(['index', 'edit', 'update']);
});
