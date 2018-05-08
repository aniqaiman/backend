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

Route::post('registerseller', 'API\SellerController@postRegisterSeller');
Route::post('registerbuyer', 'API\BuyerController@postRegisterBuyer');

Route::get('product/{product_id}', 'API\ProductController@getProductbyId');
Route::get('products', 'API\ProductController@getProducts');
Route::get('fruits', 'API\ProductController@getFruits');
Route::get('vegetables', 'API\ProductController@getVegetables');
Route::get('prices', 'API\ProductController@getPrices');
Route::get('buyers', 'API\BuyerController@getBuyers');
Route::get('sellers', 'API\SellerController@getSellers');
Route::get('buyer/{user_id}', 'API\BuyerController@getBuyer');
Route::get('seller/{user_id}', 'API\SellerController@getSeller');

// ------------------------------------------- Promo ---------------------------------------------------- //

Route::get('newproducts', 'API\ProductController@getNewProducts');
Route::get('lastpurchaseproducts', 'API\ProductController@getLastPurchaseProducts');
Route::get('bestsellingproducts', 'API\ProductController@getBestSellingProducts');

// ------------------------------------------- Order ---------------------------------------------------- //

Route::get('orders', 'API\OrderController@getOrders');
Route::get('orders/{order_id}', 'API\OrderController@getOrderDetails');

// ------------------------------------------- Stock ---------------------------------------------------- //

Route::get('stocks', 'API\StockController@getStocks');
Route::get('stocks/{stock_id}', 'API\StockController@getStockDetails');

Route::post('stocks', 'API\StockController@postStocks');

// ------------------------------------------- Cart ---------------------------------------------------- //

Route::get('carts', 'API\CartController@getCartItems');
Route::get('carts/totalitems', 'API\CartController@getTotalItems');
Route::get('carts/totalprice', 'API\CartController@getTotalPrice');

Route::post('carts', 'API\CartController@postCartItem');
Route::post('carts/confirm', 'API\CartController@postConfirm');

Route::delete('carts/{product_id}', 'API\CartController@deleteCartItem');

Route::get('playground', 'ApiController@playground');
