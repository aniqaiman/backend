<?php

/*
|-----------------------------------------------------------------
| Web Routes
|-----------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('', ['as' => 'welcome', 'uses' =>
    function () {
        return view('welcome');
    }]);

// Route::group(['middleware' => ['api','cors']], function () {

// ------------------------------------------- Dashboard ------------------------------------------- //

Route::post('dashboard', ['as' => 'createDashboard', 'uses' => 'DashboardController@createServiceDashboard']);
Route::get('dashboard', ['as' => 'dashboard', 'uses' =>
    'DashboardController@getDashboard']);

// ------------------------------------------- Price ------------------------------------------- //

Route::post('fruit/{product_id}/price/add', ['as' => 'createFruitPrice', 'uses' => 'PriceController@createFruitPrice']);
Route::get('fruit/{product_id}/detail', ['as' => 'getFruitDetail', 'uses' => 'PriceController@getFruitDetail']);
Route::get('fruit/{product_id}/editFruitPrice/{price_id}', ['as' => 'editFruitPrice', 'uses' => 'PriceController@editFruitPrice']);
Route::post('updateFruitPrice', ['as' => 'updateFruitPrice', 'uses' => 'PriceController@updateFruitPrice']);
Route::delete('fruitprice/{price_id}', ['as' => 'deleteFruitPrice', 'uses' => 'PriceController@deleteFruitPrice']);

// ------------------------------------------- Detail Fruit ------------------------------------------- //

Route::post('vege/{product_id}/price/add', ['as' => 'createVegePrice', 'uses' => 'PriceController@createVegePrice']);
Route::get('vege/{product_id}/detail', ['as' => 'getVegeDetail', 'uses' => 'PriceController@getVegeDetail']);
Route::get('vege/{product_id}/editVegePrice/{price_id}', ['as' => 'editVegePrice', 'uses' => 'PriceController@editVegePrice']);
Route::post('updateVegePrice', ['as' => 'updateVegePrice', 'uses' => 'PriceController@updateVegePrice']);
Route::delete('vegeprice', ['as' => 'deleteVegePrice', 'uses' => 'PriceController@deleteVegePrice']);

// ------------------------------------------- Order ------------------------------------------- //

Route::get('orders/receipts', 'OrderController@getOrderReceipts')->name('orders.receipts');
Route::get('orders/trackings', 'OrderController@getOrderTrackings')->name('orders.trackings');
Route::get('orders/rejects', 'OrderController@getOrderRejects')->name('orders.rejects');
Route::get('orders/transactions', 'OrderController@getOrderTransactions')->name('orders.transactions');

Route::get('orders/{order_id}', ['as' => 'orders.edit', 'uses' => 'OrderController@editOrder']);
Route::post('orders', ['as' => 'orders.create', 'uses' => 'OrderController@createOrder']);
Route::post('orders/update', ['as' => 'orders.update', 'uses' => 'OrderController@updateOrder']);
Route::put('orders/buyers/approve', ['as' => 'orders.buyers.approve', 'uses' => 'OrderController@approveBuyerOrder']);
Route::put('orders/sellers/approve', ['as' => 'orders.sellers.approve', 'uses' => 'OrderController@approveSellerStock']);
Route::put('orders/buyers/reject', ['as' => 'orders.buyers.reject', 'uses' => 'OrderController@rejectBuyerOrder']);
Route::put('orders/sellers/reject', ['as' => 'orders.sellers.reject', 'uses' => 'OrderController@rejectSellerStock']);
Route::put('orders/pending', ['as' => 'orders.pending', 'uses' => 'OrderController@pendingOrderStock']);
Route::put('orders/complete', ['as' => 'orders.complete', 'uses' => 'OrderController@completeOrderStock']);
Route::delete('orders/{order_id}', ['as' => 'deleteOrder', 'uses' => 'OrderController@deleteOrder']);

Route::group(['prefix' => 'users', 'as' => 'users.'], function () {

    // ------------------------------------------- Driver ------------------------------------------- //

    Route::get('drivers', 'DriverController@index')->name('drivers.index');
    Route::post('drivers', 'DriverController@store')->name('drivers.store');
    Route::get('drivers/{user_id}', 'DriverController@show')->show('drivers.show');
    Route::put('drivers/{user_id}', 'DriverController@update')->name('drivers.update');
    Route::delete('drivers/{user_id}', 'DriverController@destroy')->name('drivers.destroy');
    Route::get('drivers/{user_id}/edit', 'DriverController@edit')->name('drivers.edit');

    // ------------------------------------------- Seller ------------------------------------------- //

    Route::get('sellers', ['as' => 'users.sellers', 'uses' => 'SellerController@getSellers'])->name('');
    Route::get('editSeller/{seller_id}', ['as' => 'editSeller', 'uses' => 'SellerController@editSeller'])->name('');
    Route::post('seller', ['as' => 'createSeller', 'uses' => 'SellerController@createSeller'])->name('');
    Route::post('updateSeller', ['as' => 'updateSeller', 'uses' => 'SellerController@updateSeller'])->name('');
    Route::delete('seller/{seller_id}', ['as' => 'deleteSeller', 'uses' => 'SellerController@deleteSeller'])->name('');

    Route::get('seller/{seller_id}/sellerdetail', ['as' => 'sellerdetail', 'uses' => 'SellerController@getSellersDetail']);

    // ------------------------------------------- Buyer ------------------------------------------- //

    Route::get('buyers', ['as' => 'users.buyers', 'uses' => 'BuyerController@getBuyers']);
    Route::get('editBuyer/{buyer_id}', ['as' => 'editBuyer', 'uses' => 'BuyerController@editBuyer']);
    Route::post('buyers', ['as' => 'createBuyer', 'uses' => 'BuyerController@createBuyer']);
    Route::post('updateBuyer', ['as' => 'updateBuyer', 'uses' => 'BuyerController@updateBuyer']);
    Route::delete('buyer/{buyer_id}', ['as' => 'deleteBuyer', 'uses' => 'BuyerController@deleteBuyer']);

});

// ------------------------------------------- Vege ------------------------------------------- //

Route::post('vege', ['as' => 'products.vegetables.action.create', 'uses' => 'VegeController@createVege']);
Route::get('vege', ['as' => 'products.vegetables', 'uses' => 'VegeController@getVege']);
Route::get('editVege/{product_id}', ['as' => 'editVege', 'uses' => 'VegeController@editVege']);
Route::post('updateVege', ['as' => 'updateVege', 'uses' => 'VegeController@updateVege']);
Route::delete('vege/{product_id}', ['as' => 'deleteVege', 'uses' => 'VegeController@deleteVege']);

// ------------------------------------------- Fruit ------------------------------------------- //

Route::post('products/fruits', ['as' => 'products.fruits.action.create', 'uses' => 'FruitController@createFruit']);
Route::get('products/fruits', ['as' => 'products.fruits', 'uses' => 'FruitController@getFruit']);
Route::get('products/fruits/{product_id}', ['as' => 'products.fruits.update', 'uses' => 'FruitController@editFruit']);
Route::put('products/fruits', ['as' => 'products.fruits.action.update', 'uses' => 'FruitController@updateFruit']);
Route::delete('fruit/{product_id}', ['as' => 'deleteFruit', 'uses' => 'FruitController@deleteFruit']);

Route::post('send', 'EmailController@send');

// ------------------------------------------- Others ------------------------------------------- //

Route::get('playground', 'ApiController@playground');
