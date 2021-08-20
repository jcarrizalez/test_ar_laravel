<?php

use Illuminate\Http\Request;
use App\Http\Controllers\BookController;

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

# RUTAS SOLO CON JWT
Route::group(['middleware' => ['jwt.auth']], function() {

	#grupo de rutas para libros
	Route::group(['prefix' => 'books'], function() {
	
		Route::get(null, 			'BookController@index')->name('books');
		Route::get('{slug}', 		'BookController@file')->name('book-file');
		Route::get('{slug}/content', 'BookController@content')->name('book-content');
	});
});
