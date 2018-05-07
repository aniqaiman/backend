<?php

use Illuminate\Http\Request;

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

Route::get('auth/user', 'ApiController@getAuthUser');
Route::get('auth/verify/{token}', 'ApiController@verifyUserEmail');

Route::post('auth/login', 'ApiController@login');
Route::post('auth/verifyrecaptcha', 'ApiController@verifyReCAPTCHA');

Route::post('registerseller', 'Api\SellerController@postRegisterSeller');
Route::post('registerbuyer', 'Api\BuyerController@postRegisterBuyer');

Route::get('product/{product_id}', 'Api\ProductController@getProductbyId');
Route::get('products', 'Api\ProductController@getProducts');
Route::get('fruits', 'Api\ProductController@getFruits');
Route::get('vegetables', 'Api\ProductController@getVegetables');
Route::get('prices', 'Api\ProductController@getPrices');
Route::get('buyers', 'Api\BuyerController@getBuyers');
Route::get('sellers', 'Api\SellerController@getSellers');
Route::get('drivers', 'Api\DriverController@getDrivers');
Route::get('users', 'Api\UserController@getUsers');
Route::get('buyer/{user_id}', 'Api\BuyerController@getBuyer');
Route::get('driver/{user_id}', 'Api\DriverController@getDriver');
Route::get('seller/{user_id}', 'Api\SellerController@getSeller');
Route::get('user/{user_id}', 'Api\UserController@getUser');

// ------------------------------------------- Promo ---------------------------------------------------- //

Route::get('newproducts', 'Api\ProductController@getNewProducts');
Route::get('lastpurchaseproducts', 'Api\ProductController@getLastPurchaseProducts');
Route::get('bestsellingproducts', 'Api\ProductController@getBestSellingProducts');

// ------------------------------------------- Order ---------------------------------------------------- //

Route::get('orders', 'Api\OrderController@getOrders');
Route::get('orders/{order_id}', 'Api\OrderController@getOrderDetails');

// ------------------------------------------- Stock ---------------------------------------------------- //

Route::get('stocks', 'Api\StockController@getStocks');
Route::get('stocks/{stock_id}', 'Api\StockController@getStockDetails');

Route::post('stocks', 'Api\StockController@postStocks');

// ------------------------------------------- Cart ---------------------------------------------------- //

Route::get('carts', 'Api\CartController@getCartItems');
Route::get('carts/totalitems', 'Api\CartController@getTotalItems');
Route::get('carts/totalprice', 'Api\CartController@getTotalPrice');

Route::post('carts', 'Api\CartController@postCartItem');
Route::post('carts/confirm', 'Api\CartController@postConfirm');

Route::delete('carts/{product_id}', 'Api\CartController@deleteCartItem');

Route::get('playground', 'ApiController@playground');
