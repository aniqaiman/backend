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

// -------------------------------------------Seller----------------------------------------------------

	Route::post('/seller', ['as'=>'createSeller', 'uses'=>'SellerController@createSeller']);
	Route::get('/seller',['as'=>'seller','uses'=>'SellerController@getSeller']);
	Route::get('/editSeller/{seller_id}',['as'=>'editSeller','uses'=>'SellerController@editSeller']);
	Route::post('/updateSeller',['as'=>'updateSeller','uses'=>'SellerController@updateSeller']);
	Route::delete('/seller/{seller_id}',['as'=>'deleteSeller','uses'=>'SellerController@deleteSeller']);

// -------------------------------------------Group----------------------------------------------------

	Route::post('/group', ['as'=>'createGroup', 'uses'=>'GroupController@createGroup']);
	Route::get('/group', ['as'=>'group', 'uses'=>'GroupController@getGroup', 'roles'=>['admin']]);
	Route::get('/editGroup/{group_id}',['as'=>'editGroup','uses'=>'GroupController@editGroup']);
	Route::post('/updateGroup',['as'=>'updateGroup','uses'=>'GroupController@updateGroup']);
	Route::delete('/group/{group_id}',['as'=>'deleteGroup','uses'=>'GroupController@deleteGroup']);

// -------------------------------------------User----------------------------------------------------

	Route::post('/users', ['as' =>'createUser', 'uses'=>'UserController@createUser']);
	Route::get('/users',['as'=>'users','uses'=>'UserController@getUser','roles'=>['admin']]);
	Route::get('/editUser/{user_id}', ['as' => 'editUser', 'uses' => 'UserController@editUser']);
	Route::post('/updateUser', ['as' => 'updateUser', 'uses' => 'UserController@updateUser']);
	Route::delete('/users/{user_id}',['as'=>'deleteUser','uses'=>'UserController@deleteUser']);

// -------------------------------------------Driver----------------------------------------------------	

	Route::post('/driver', ['as'=>'createDriver', 'uses'=>'DriverController@createDriver']);
	Route::get('/driver', ['as'=>'driver','uses'=>'DriverController@getDriver']);
	Route::get('/editDriver/{driver_id}',['as'=>'editDriver','uses'=>'DriverController@editDriver']);
	Route::post('/updateDriver',['as'=>'updateDriver','uses'=>'DriverController@updateDriver']);
	Route::delete('/driver/{driver_id}',['as'=>'deleteDriver','uses'=>'DriverController@deleteDriver']);

// -------------------------------------------Buyer----------------------------------------------------	

	Route::post('/buyer', ['as'=>'createBuyer', 'uses'=>'BuyerController@createBuyer']);
	Route::get('/buyer', ['as'=>'buyer','uses'=>'BuyerController@getBuyer']);
	Route::get('/editBuyer/{buyer_id}',['as'=>'editBuyer','uses'=>'BuyerController@editBuyer']);
	Route::post('/updateBuyer',['as'=>'updateBuyer','uses'=>'BuyerController@updateBuyer']);
	Route::delete('/buyer/{buyer_id}',['as'=>'deleteBuyer','uses'=>'BuyerController@deleteBuyer']);

// -------------------------------------------Product----------------------------------------------------

	Route::post('/product', ['as'=>'createProduct', 'uses'=>'ProductController@createProduct']);
	Route::get('/product', ['as'=>'product','uses'=>'ProductController@getProduct']);
	Route::get('editProduct/{product_id}',['as'=>'editProduct','uses'=>'ProductController@editProduct']);
	Route::post('/updateProduct',['as'=>'updateProduct','uses'=>'ProductController@updateProduct']);
	Route::delete('/product/{product_id}',['as'=>'deleteProduct','uses'=>'ProductController@deleteProduct']);

// -------------------------------------------Price----------------------------------------------------

	Route::post('/price', ['as'=>'createPrice', 'uses'=>'PriceController@createPrice']);
	Route::get('/price', ['as'=>'price','uses'=>'PriceController@getPrice']);
	Route::get('editPrice/{price_id}',['as'=>'editPrice','uses'=>'PriceController@editPrice']);
	Route::post('/updatePrice',['as'=>'updatePrice','uses'=>'PriceController@updatePrice']);
	Route::delete('/price/{price_id}',['as'=>'deletePrice','uses'=>'PriceController@deletePrice']);

// -------------------------------------------API----------------------------------------------------	

	Route::post('/api/registerseller', 'Api\SellerController@postRegisterSeller');
	Route::post('/api/registerbuyer', 'Api\BuyerController@postRegisterBuyer');


	Route::get('/api/products','Api\ProductController@getProduct');
	Route::get('/api/product/{product_id}','Api\ProductController@getProductbyId');