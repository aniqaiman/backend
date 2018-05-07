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

Route::get('/', ['as' => 'welcome', 'uses' =>
    function () {
        return view('welcome');
    }]);

// ------------------------------------------- Dashboard ------------------------------------------- //

Route::post('dashboard', ['as' => 'createDashboard', 'uses' => 'DashboardController@createServiceDashboard']);
Route::get('dashboard', ['as' => 'dashboard', 'uses' =>
    'DashboardController@getDashboard']);

// ------------------------------------------- User ------------------------------------------- //

Route::prefix('users')
    ->name('users.')
    ->group(function () {

        // ------------------------------------------- Driver ------------------------------------------- //

        Route::get('drivers', 'DriverController@index')->name('drivers.index');
        Route::post('drivers', 'DriverController@store')->name('drivers.store');
        Route::get('drivers/{user_id}', 'DriverController@show')->name('drivers.show');
        Route::put('drivers/{user_id}', 'DriverController@update')->name('drivers.update');
        Route::delete('drivers/{user_id}', 'DriverController@destroy')->name('drivers.destroy');
        Route::get('drivers/{user_id}/edit', 'DriverController@edit')->name('drivers.edit');

        // ------------------------------------------- Seller ------------------------------------------- //

        Route::get('sellers', 'SellerController@index')->name('sellers.index');
        Route::post('sellers', 'SellerController@store')->name('sellers.store');
        Route::get('sellers/{user_id}', 'SellerController@show')->name('sellers.show');
        Route::put('sellers/{user_id}', 'SellerController@update')->name('sellers.update');
        Route::delete('sellers/{user_id}', 'SellerController@destroy')->name('sellers.destroy');
        Route::get('sellers/{user_id}/edit', 'SellerController@edit')->name('sellers.edit');

        // ------------------------------------------- Buyer ------------------------------------------- //

        Route::get('buyers', 'BuyerController@index')->name('buyers.index');
        Route::post('buyers', 'BuyerController@store')->name('buyers.store');
        Route::put('buyers', 'BuyerController@update')->name('buyers.update');
        Route::delete('buyers/{user_id}', 'BuyerController@destroy')->name('buyers.destroy');
        Route::get('buyers/{user_id}/edit', 'BuyerController@edit')->name('buyers.edit');

    });

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

Route::prefix('orders')
    ->name('orders.')
    ->group(function () {

        // ------------------------------------------- Order ------------------------------------------- //

        Route::get('receipts', 'OrderController@getOrderReceipts')->name('index.receipts');
        Route::get('trackings', 'OrderController@getOrderTrackings')->name('index.trackings');
        Route::get('rejects', 'OrderController@getOrderRejects')->name('index.rejects');
        Route::get('transactions', 'OrderController@getOrderTransactions')->name('index.transactions');

        Route::post('orders', 'OrderController@store')->name('store');
        Route::put('orders', 'OrderController@update')->name('update');
        Route::get('{order_id}', 'OrderController@edit')->name('edit');
        Route::delete('{order_id}', 'OrderController@destroy')->name('destroy');

        Route::put('buyers/approve', 'OrderController@approveBuyerOrder')->name('update.status.buyers.approve');
        Route::put('buyers/reject', 'OrderController@rejectBuyerOrder')->name('update.status.buyers.reject');

        Route::put('sellers/approve', 'OrderController@approveSellerStock')->name('update.status.sellers.reject');
        Route::put('sellers/reject', 'OrderController@rejectSellerStock')->name('update.status.sellers.reject');

        Route::put('pending', ['as' => 'pending', 'uses' => 'OrderController@pendingOrderStock'])->name('update.status.pending');
        Route::put('complete', ['as' => 'complete', 'uses' => 'OrderController@completeOrderStock'])->name('update.status.complete');
    
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
