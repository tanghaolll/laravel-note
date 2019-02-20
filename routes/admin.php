<?php
Route::group(['prefix'=>'admin'],function (){
    //登陆展示
    Route::get('/login',"\App\Admin\Controller\LoginController@index");
    //登陆行为
    Route::post('/login',"\App\Admin\Controller\LoginController@login");
    // 登出行为
    Route::get('/logout',"\App\Admin\Controller\LoginController@logout");
    Route::group(['middleware'=>'auth:admin'],function (){
        //首页
        Route::get('/home',"\App\Admin\Controller\HomeController@index");
        //管理人员模块
        Route::get("/users","\App\Admin\Controller\UserController@index");
        Route::get("/users/create","\App\Admin\Controller\UserController@create");
        Route::post("/users/store","\App\Admin\Controller\UserController@store");
        //审核模块
        Route::get('/posts',"\App\Admin\Controller\PostController@index");
        Route::post('/posts/{post}/status',"\App\Admin\Controller\PostController@status");

    });

});