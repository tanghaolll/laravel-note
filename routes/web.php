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
//文章列表
Route::get('/posts', '\App\Http\Controllers\PostController@index');
//创建文章
Route::get('/posts/create','\App\Http\Controllers\PostController@create');
Route::post('/posts','\App\Http\Controllers\PostController@store');
//文章详情页
Route::get('/posts/{port}','\App\Http\Controllers\PostController@show');

//编辑文章
Route::get('/posts/{port}/edit','\App\Http\Controllers\PostController@edit');
Route::put('/posts/{port}','\App\Http\Controllers\PostController@update');
//删除文章
Route::get('/posts/delete','\App\Http\Controllers\PostController@delete');



