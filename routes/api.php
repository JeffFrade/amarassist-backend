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

Route::group(['prefix' => 'contacts'], function () {
    Route::get('/', 'ContactController@index')->name('contacts.index');
    Route::post('/store', 'ContactController@store')->name('contacts.store');
    Route::get('/show/{id}', 'ContactController@show')->name('contacts.show');
});
