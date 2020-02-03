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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index')->name('admin_dashboard');

Route::get('/admin/user', 'UserController@index')->name('user_list')->middleware('admin');
Route::get('/admin/user/detail/{id}', 'UserController@detail')->name('user_detail')->middleware('admin');
Route::get('/admin/user/add', 'UserController@add')->name('user_add')->middleware('admin');
Route::post('/admin/user/create', 'UserController@create')->name('user_create')->middleware('admin');
Route::get('/admin/user/edit/{id}', 'UserController@edit')->name('user_edit')->middleware('admin');
Route::put('/admin/user/update/{id}', 'UserController@update')->name('user_update')->middleware('admin');
Route::put('/admin/user/password/{id}', 'UserController@changePassword')->name('user_password')->middleware('admin');
Route::get('/admin/user/delete/{id}', 'UserController@delete')->name('user_delete')->middleware('admin');

Route::resource('/admin/category', 'CategoryController')->only([
    'index', 'store', 'update'
]);

Route::get('/admin/category/delete/{category}', 'CategoryController@destroy')->name('category.destroy');

Route::get('/admin/sub-category', 'SubCategoryController@index')->name('sub_cate');
Route::post('/admin/sub-category/create', 'SubCategoryController@store')->name('sub_cate_create');
Route::put('/admin/sub-category/update/{id}', 'SubCategoryController@update')->name('sub_cate_update');
Route::get('/admin/sub-category/delete/{id}', 'SubCategoryController@destroy')->name('sub_cate_delete');

Route::get('/admin/product', 'ProductController@index')->name('product');
Route::get('/admin/product/add', 'ProductController@add')->name('product_add');
Route::post('/admin/product/create', 'ProductController@create')->name('product_create');
Route::get('/admin/product/edit/{id}', 'ProductController@edit')->name('product_edit');
Route::put('/admin/product/update/{id}', 'ProductController@update')->name('product_update');
Route::get('/admin/product/delete/{id}', 'ProductController@delete')->name('product_delete');
Route::post('/admin/product/category', 'ProductController@add_category')->name('product_cate');
Route::post('/admin/product/sub-category', 'ProductController@add_sub_category')->name('product_sub_cate');

Route::post('/admin/product-variant/create', 'ProductVariantController@create')->name('pv_create');

Route::post('/admin/images/upload', 'ImageController@upload')->name('images_upload');
Route::post('/admin/images/delete', 'ImageController@delete')->name('images_delete');
