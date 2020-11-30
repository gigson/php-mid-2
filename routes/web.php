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


Auth::routes();

Route::get('/', 'PublicController@index')->name('main');
Route::get('/category{categoryId}', 'PublicController@indexByCategory')->name('category');
Route::get('/post/{postId}', 'PublicController@show')->name('single');
Route::get('/search', 'PublicController@search')->name('search');

Route::get('/admin', 'HomeController@index')->name('home');

Route::get('/admin/categories', 'HomeController@indexCategories')->name('categories');
Route::post('/admin/category/store', 'HomeController@storeCategory')->name('storeCategory');
Route::post('/admin/category/update', 'HomeController@updateCategory')->name('updateCategory');
Route::post('/admin/category/destroy', 'HomeController@destroyCategory')->name('deleteCategory');

Route::get('/admin/posts', 'HomeController@indexPostsForEdit')->name('postsForEdit');
Route::get('/admin/post/edit/{postId}', 'HomeController@editPost')->name('editPost');
Route::post('/admin/post/update', 'HomeController@updatePost')->name('updatePost');

Route::get('/admin/post/create', 'HomeController@createPost')->name('createPost');
Route::post('/admin/post/store', 'HomeController@storePost')->name('storePost');
Route::post('/admin/post/destroy', 'HomeController@destroyPost')->name('deletePost');


Auth::routes();


