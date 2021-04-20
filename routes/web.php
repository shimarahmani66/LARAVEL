<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\lib\Captcha;

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

//added-in-another Route::get('/', 'SiteController@index');
Route::get('admin/login','Auth\LoginController@admin_login');
Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::resource('category','admin\CategoryController');
    Route::resource('product','admin\ProductController');
    Route::get('comment','admin\CommentController@index');
    Route::get('','admin\AdminController@index');
    Route::delete('comment/{id}','admin\CommentController@destroy');
    Route::post('set_status','admin\CommentController@set_status');
    Route::post('comment/create','admin\CommentController@create');
    Route::resource('discounts','admin\DiscountController');
    Route::get('statistics','admin\AdminController@statistics');
    Route::get('setting','admin\AdminController@setting_form');
    Route::post('setting','admin\AdminController@setting');
    Route::get('order','admin\OrderController@index');
    Route::get('order/{id}','admin\OrderController@show');
    Route::delete('order/{id}','admin\OrderController@destroy');
    Route::get('users','admin\UsersController@index');
    Route::get('users/{id}','admin\UsersController@show');
    Route::delete('users/{id}','admin\UsersController@destroy');
});

//added-in-another Route::post('cart','SiteController@add_cart');
//not-in Route::get('cart','SiteController@cart');
Route::post('change_number','SiteController@change_number');
Route::post('del_cart','SiteController@del_cart');
//added-in-another Route::resource('/admin/category','admin\CategoryController');
//added-in-another Route::resource('/admin/product','admin\ProductController');
Route::prefix('user')->group(function () {
    Route::post('add_order','UserController@add_order');
    Route::get('orders','UserController@orders');
    Route::get('orders1/{id}','UserController@orders1');
    Route::get('order/{order_id}/{product}','UserController@order');
});
// Route::get('user',function(){
//     echo 'ok';
// })->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('captcha', function(){
    $captcha=new Captcha();
    $captcha->create();
});
Route::post('set_discount','SiteController@set_discount');

//added-in-another Route::get('{title}','SiteController@show');
Route::post('add_comment','SiteController@add_comment');
Route::middleware(['test'])->group(function () {
    Route::get('/', 'SiteController@index');
    Route::post('cart','SiteController@add_cart');
    Route::get('cart','SiteController@cart');
    Route::get('category/{cate1}','SiteController@cat1');
    Route::get('category/{cate1}/{cat2}','SiteController@cat2');
    Route::get('user','UserController@index');
    Route::get('{title}','SiteController@show');
});

