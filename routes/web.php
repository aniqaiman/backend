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

Route::get('/', ['as' => 'dashboard','uses' => 
	function () {
	return view('dashboard');
}]);

Route::post('/seller', ['as'=>'createSeller', 'uses'=>'SellerController@createSeller']);
Route::get('/seller',['as'=>'seller','uses'=>'SellerController@getSeller']);
Route::get('/editSeller/{seller_id}',['as'=>'editSeller','uses'=>'SellerController@editSeller']);
Route::post('/updateSeller',['as'=>'updateSeller','uses'=>'SellerController@updateSeller']);
Route::delete('/seller/{seller_id}',['as'=>'deleteSeller','uses'=>'SellerController@deleteSeller']);
