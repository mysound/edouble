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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth' , 'admin']], function(){
	Route::get('/', 'DashboardController@dashboard')->name('admin.index');
	Route::resource('/category', 'CategoriesController', ['as' => 'admin']);
	Route::get('/product/search', 'ProductsController@search')->name('admin.product.search');
	Route::resource('/product', 'ProductsController', ['as' => 'admin']);
	Route::resource('/ganre', 'GanresController', ['as' => 'admin']);
	Route::resource('/brand', 'BrandsController', ['as' => 'admin']);
	Route::resource('/slide', 'SlidesController', ['as' => 'admin']);
	Route::get('/upload/create', 'ExcelController@create')->name('admin.upload.create');
	Route::post('/upload', 'ExcelController@importExcel')->name('admin.upload.store');
	Route::get('/order', 'DashboardController@orders')->name('admin.order.index');
	Route::get('/order/addtracking/{order}', 'DashboardController@addTracking')->name('admin.addtracking');
	Route::post('/order', 'DashboardController@storeTracking')->name('admin.tracking.store');
	Route::get('/order/details/{order}', 'DashboardController@orderDetails')->name('admin.order.details');
	Route::get('/order/addtracking/{order}/edit', 'DashboardController@editTracking')->name('admin.tracking.edit');
	Route::put('/order/addtracking/{order}', 'DashboardController@updateTracking')->name('admin.tracking.update');
});

Route::get('/', 'IndexController@index')->name('shop');

Auth::routes();

Route::put('/user/{user}', 'UsersController@update')->name('user.update');
Route::get('/user/{user}/edit', 'UsersController@edit')->name('user.edit');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/user/addresses', 'AddressesController');

Route::get('/store/view/{product}', 'StoreController@itemView')->name('product.view');
Route::get('/store', 'StoreController@shope');
Route::get('/store/{ganre}', 'StoreController@ganreSearch');
Route::get('/store', 'StoreController@search')->name('store.search');

Route::resource('cart', 'CartController');
Route::get('empty', 'CartController@empty')->name('cart.empty');

Route::post('/order', 'OrdersController@store')->name('order.store');
Route::get('/order/checkout/{order}', 'OrdersController@checkoutPage')->name('order.checkout')->middleware('auth', 'checkorder');
Route::get('/order/details/{order}', 'OrdersController@orderDetails')->name('order.details')->middleware('auth', 'checkorder');;

Route::post('create-payment', 'PaymentController@create')->name('create-payment');
Route::get('execute-payment/{order}', 'PaymentController@execute')->name('execute-payment');
Route::get('/payment-approved', 'PaymentController@approved')->name('payment-approved');