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

// Route::get('/', function () {
//     return view('client.layout.index');
// });
Route::get('/','HomeController@index')->name('/');
Route::get('product-detail/{id}','ProductDetailController@show');

Route::resource('cart','CartController');

Route::get('addcart/{id}','CartController@addCart')->name('addCart');

// Route::view('cart','client.pages.cart');
// Route::get('register',function(){ 
// 	return view('register.register');
// })->name('register');
Route::get('client-register',function(){ 
	return view('client.pages.register');
})->name('client-register');
Route::post('post-register','UserController@store');
Route::post('client-login', 'UserController@loginClient')->name('client-login');
Route::get('logout','UserController@logout')->name('logout');
//Admin
Route::group(['prefix' => 'admin'], function() {
    Route::view('/','admin.layout.index')->name('admin.index');
    Route::get('order/search','AjaxController@ajax_Order')->name('ajax-order');
    Route::resource('product','ProductController');
    Route::resource('order','OrderController');
    
});
Auth::routes(); // được tạo khi chạy lên make:auth

Route::get('/home', 'HomeController@index')->name('home');

