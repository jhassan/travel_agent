<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

// Parties
Route::group(
	array('prefix' => '/parties','before' => ''), function () {
		Route::get('add', array('as' => 'add/party', 'uses' => 'PartyController@add'));
  		Route::post('add_new', 'PartyController@create');
  		Route::get('/', array('as' => 'parties', 'uses' => 'PartyController@index'));
  		Route::get('{id}/edit', array('as' => 'parties.update', 'uses' => 'PartyController@edit'));
  		Route::post('{id}/edit', 'PartyController@update');
  		Route::get('delete_party', array('as'=>'delete_party', 'uses' => 'PartyController@destroy'));
	});

// Products
Route::group(
	array('prefix' => '/products','before' => ''), function () {
		Route::get('add', array('as' => 'add/product', 'uses' => 'ProductController@add'));
  		Route::post('add_new', 'ProductController@create');
  		Route::get('/', array('as' => 'products', 'uses' => 'ProductController@index'));
  		Route::get('{id}/edit', array('as' => 'products.update', 'uses' => 'ProductController@edit'));
  		Route::post('{id}/edit', 'ProductController@update');
  		Route::get('delete_product', array('as'=>'delete_product', 'uses' => 'ProductController@destroy'));
	});

// Purchase Stcok
Route::group(
	array('prefix' => '/purchase_stock','before' => ''), function () {
		Route::get('add', array('as' => 'add/purchase_stock', 'uses' => 'PurchaseStockController@add'));
  		Route::post('add', 'PurchaseStockController@create');
  		Route::get('/', array('as' => 'purchase_stock', 'uses' => 'PurchaseStockController@index'));
  		Route::get('{id}/edit', array('as' => 'purchase_stock.update', 'uses' => 'PurchaseStockController@edit'));
  		Route::post('{id}/edit', 'PurchaseStockController@update');
  		Route::get('delete_purchase_stock', array('as'=>'delete_purchase_stock', 'uses' => 'PurchaseStockController@destroy'));
	});

// Sale Stcok
Route::group(
  array('prefix' => '/sale_stock','before' => ''), function () {
    Route::get('add', array('as' => 'add/sale_stock', 'uses' => 'SaleStockController@add'));
      Route::post('add', 'SaleStockController@create');
      Route::get('/', array('as' => 'sale_stock', 'uses' => 'SaleStockController@index'));
      Route::get('{id}/edit', array('as' => 'sale_stock.update', 'uses' => 'SaleStockController@edit'));
      Route::post('{id}/edit', 'SaleStockController@update');
      Route::get('delete_sale_stock', array('as'=>'delete_sale_stock', 'uses' => 'SaleStockController@destroy'));
      Route::get('check_total_stcok', array('as'=>'check_total_stcok', 'uses' => 'SaleStockController@check_total_stcok'));
      Route::get('{id}/check_item_stock_detail', array('as'=>'check_item_stock_detail', 'uses' => 'SaleStockController@check_item_stock_detail'));
  });

// Reports
Route::group(
  array('prefix' => '/reports','before' => ''), function () {
      Route::get('view_purchase_stock', array('as' => 'add/view_purchase_stock', 'uses' => 'ReportController@view_purchase_stock'));
      Route::get('view_sale_stock', array('as' => 'add/view_sale_stock', 'uses' => 'ReportController@view_sale_stock'));
      Route::get('view_today_stock', array('as' => 'add/view_today_stock', 'uses' => 'ReportController@view_today_stock'));
  });

// List Price
Route::group(
  array('prefix' => '/list_price','before' => ''), function () {
      Route::get('/', array('as' => '/', 'uses' => 'ListPriceController@index'));
      Route::get('update_list_price', array('as'=>'update_list_price', 'uses' => 'ListPriceController@update_list_price'));
      
  });

// Accounts
Route::group(
  array('prefix' => '/accounts','before' => ''), function () {
      Route::get('list_transections', array('as' => 'list_transections', 'uses' => 'AccountController@list_transections'));
      Route::get('frm_ledger', array('as' => 'frm_ledger', 'uses' => 'AccountController@frm_ledger'));
      Route::post('view_ledger', array('as' => 'view_ledger', 'uses' => 'AccountController@view_ledger'));
  });

// Vouchers
Route::group(
  array('prefix' => '/vouchers','before' => ''), function () {
      Route::get('sale_voucher', array('as' => 'sale_voucher', 'uses' => 'VoucherController@sale_voucher'));
      Route::post('add_sale', 'VoucherController@create');
      Route::get('list_sale_voucher', array('as' => 'voucher', 'uses' => 'VoucherController@list_sale_voucher'));
  });

// Profile
Route::group(
  array('prefix' => '/profiles','before' => ''), function () {
    Route::get('add', array('as' => 'add/profile', 'uses' => 'ProfileController@add'));
      Route::post('add_new', 'ProfileController@create');
      Route::get('/', array('as' => 'profile', 'uses' => 'ProfileController@index'));
      Route::get('{id}/edit', array('as' => 'parties.update', 'uses' => 'ProfileController@edit'));
      Route::post('{id}/edit', 'ProfileController@update');
      Route::get('delete_party', array('as'=>'delete_party', 'uses' => 'ProfileController@destroy'));
  });

// Manage Payment Vouchers
Route::group(
  array('prefix' => '/payment_vouchers','before' => ''), function () {
    Route::get('receive_payment', array('as' => 'receive_payment/payment_voucher', 'uses' => 'PaymentVoucherController@receive_payment'));
    Route::get('payment_voucher', array('as' => 'payment_voucher/payment_voucher', 'uses' => 'PaymentVoucherController@payment_voucher'));
    Route::get('journal_voucher', array('as' => 'journal_voucher/payment_voucher', 'uses' => 'PaymentVoucherController@journal_voucher'));
      Route::post('add_new', 'ProfileController@create');
      Route::get('/', array('as' => 'profile', 'uses' => 'ProfileController@index'));
      Route::get('{id}/edit', array('as' => 'parties.update', 'uses' => 'ProfileController@edit'));
      Route::post('{id}/edit', 'ProfileController@update');
      Route::get('delete_party', array('as'=>'delete_party', 'uses' => 'ProfileController@destroy'));
  });

//users
Route::group(
 array('prefix' => '/users','before' => ''), function () {
    Route::get('add', array('as' => 'add/user', 'uses' => 'UserController@add'));
      Route::post('add_new', 'UserController@create');
      Route::get('/', array('as' => 'user', 'uses' => 'UserController@index'));
      Route::get('{id}/edit', array('as' => 'users.update', 'uses' => 'UserController@edit'));
      Route::post('{id}/edit', 'UserController@update');
      Route::get('delete_user', array('as'=>'delete_user', 'uses' => 'UserController@destroy'));
  });


//permissions
Route::group(
 array('prefix' => '/permissions','before' => ''), function () {
    Route::get('add', array('as' => 'add/permissions', 'uses' => 'PermissionController@add'));
    Route::post('add_new', 'PermissionController@create');
    Route::get('/', array('as' => 'permission', 'uses' => 'PermissionController@index'));
    Route::get('{id}/edit', array('as' => 'users.update', 'uses' => 'PermissionController@edit'));
    Route::post('{id}/edit', 'PermissionController@update');
    Route::get('delete_permission', array('as'=>'delete_permission', 'uses' => 'PermissionController@destroy'));
  });
