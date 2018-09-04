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
	Route::resource('/product', 'ProductsController', ['as' => 'admin']);
	Route::resource('/ganre', 'GanresController', ['as' => 'admin']);
	Route::resource('/brand', 'BrandsController', ['as' => 'admin']);
	Route::resource('/slide', 'SlidesController', ['as' => 'admin']);
	Route::get('/upload/create', 'ExcelController@create')->name('admin.upload.create');
	Route::post('/upload', 'ExcelController@importExcel')->name('admin.upload.store');
});

Route::get('/', 'IndexController@index')->name('shop');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/store/view/{product}', 'StoreController@itemView')->name('product.view');
Route::get('/store', 'StoreController@shope');
Route::get('/store/{ganre}', 'StoreController@ganreSearch');
Route::post('/store', 'StoreController@search')->name('store.search');

Route::resource('cart', 'CartController');
Route::get('empty', 'CartController@empty')->name('cart.empty');