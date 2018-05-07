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

// ------------------------------------------- Group ------------------------------------------- //

Route::post('group', ['as' => 'createGroup', 'uses' => 'GroupController@createGroup']);
Route::get('group', ['as' => 'group', 'uses' => 'GroupController@getGroup', 'roles' => ['admin']]);
Route::get('editGroup/{group_id}', ['as' => 'editGroup', 'uses' => 'GroupController@editGroup']);
Route::post('updateGroup', ['as' => 'updateGroup', 'uses' => 'GroupController@updateGroup']);
Route::delete('group/{group_id}', ['as' => 'deleteGroup', 'uses' => 'GroupController@deleteGroup']);

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

// ------------------------------------------- User ------------------------------------------- //

Route::post('users', ['as' => 'createUser', 'uses' => 'UserController@createUser']);
Route::get('users/{user_id}', ['as' => 'user', 'uses' => 'UserController@getUser']);
Route::get('editUser/{user_id}', ['as' => 'editUser', 'uses' => 'UserController@editUser']);
Route::post('updateUser', ['as' => 'updateUser', 'uses' => 'UserController@updateUser']);
Route::delete('users/{user_id}', ['as' => 'deleteUser', 'uses' => 'UserController@deleteUser']);

// ------------------------------------------- Driver ------------------------------------------- //

Route::post('driver', ['as' => 'createDriver', 'uses' => 'DriverController@createDriver']);
Route::get('driver', ['as' => 'users.drivers', 'uses' => 'DriverController@getDriver']);
Route::get('editDriver/{driver_id}', ['as' => 'editDriver', 'uses' => 'DriverController@editDriver']);
Route::post('updateDriver', ['as' => 'updateDriver', 'uses' => 'DriverController@updateDriver']);
Route::delete('driver/{driver_id}', ['as' => 'deleteDriver', 'uses' => 'DriverController@deleteDriver']);

Route::get('driver/{driver_id}/driverdetail', ['as' => 'driverdetail', 'uses' => 'DriverController@getDriverDetail']);

// ------------------------------------------- Seller ------------------------------------------- //

Route::get('sellers', ['as' => 'users.sellers', 'uses' => 'SellerController@getSellers']);
Route::get('editSeller/{seller_id}', ['as' => 'editSeller', 'uses' => 'SellerController@editSeller']);
Route::post('seller', ['as' => 'createSeller', 'uses' => 'SellerController@createSeller']);
Route::post('updateSeller', ['as' => 'updateSeller', 'uses' => 'SellerController@updateSeller']);
Route::delete('seller/{seller_id}', ['as' => 'deleteSeller', 'uses' => 'SellerController@deleteSeller']);

Route::get('seller/{seller_id}/sellerdetail', ['as' => 'sellerdetail', 'uses' => 'SellerController@getSellersDetail']);

// ------------------------------------------- Buyer ------------------------------------------- //

Route::get('buyers', ['as' => 'users.buyers', 'uses' => 'BuyerController@getBuyers']);
Route::get('editBuyer/{buyer_id}', ['as' => 'editBuyer', 'uses' => 'BuyerController@editBuyer']);
Route::post('buyers', ['as' => 'createBuyer', 'uses' => 'BuyerController@createBuyer']);
Route::post('updateBuyer', ['as' => 'updateBuyer', 'uses' => 'BuyerController@updateBuyer']);
Route::delete('buyer/{buyer_id}', ['as' => 'deleteBuyer', 'uses' => 'BuyerController@deleteBuyer']);

// ------------------------------------------- Vege ------------------------------------------- //

Route::post('vege', ['as' => 'inventories.vegetables.action.create', 'uses' => 'VegeController@createVege']);
Route::get('vege', ['as' => 'inventories.vegetables', 'uses' => 'VegeController@getVege']);
Route::get('editVege/{product_id}', ['as' => 'editVege', 'uses' => 'VegeController@editVege']);
Route::post('updateVege', ['as' => 'updateVege', 'uses' => 'VegeController@updateVege']);
Route::delete('vege/{product_id}', ['as' => 'deleteVege', 'uses' => 'VegeController@deleteVege']);

// ------------------------------------------- Fruit ------------------------------------------- //

Route::post('inventories/fruits', ['as' => 'inventories.fruits.action.create', 'uses' => 'FruitController@createFruit']);
Route::get('inventories/fruits', ['as' => 'inventories.fruits', 'uses' => 'FruitController@getFruit']);
Route::get('inventories/fruits/{product_id}', ['as' => 'inventories.fruits.update', 'uses' => 'FruitController@editFruit']);
Route::put('inventories/fruits', ['as' => 'inventories.fruits.action.update', 'uses' => 'FruitController@updateFruit']);
Route::delete('fruit/{product_id}', ['as' => 'deleteFruit', 'uses' => 'FruitController@deleteFruit']);

Route::post('send', 'EmailController@send');

// ------------------------------------------- Others ------------------------------------------- //

Route::get('playground', 'ApiController@playground');
