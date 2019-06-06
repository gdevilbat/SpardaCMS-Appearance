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

Route::group(['prefix' => 'control', 'middleware' => 'core.menu'], function() {
    
	Route::group(['middleware' => 'core.auth'], function() {

		Route::group(['prefix' => 'menu'], function() {
	        /*=============================================
	        =            User CMS            =
	        =============================================*/
	        
			    Route::get('master', 'MenuController@index')->middleware('can:menu-appearance')->name('menu');
			    Route::post('form', 'MenuController@store')->middleware('can:create-appearance')->name('menu');
			    Route::delete('form', 'MenuController@destroy')->name('menu');

	        /*=====  End of User CMS  ======*/
		});

        
	});
});

