<?php
Route::group(['prefix'=>'admin'],function (){
    //登陆展示
    Route::get('/login',"\App\Admin\Controller\LoginController@index");
    //登陆行为
    Route::post('/login',"\App\Admin\Controller\LoginController@login");
    // 登出行为
    Route::get('/logout',"\App\Admin\Controller\LoginController@logout");
    //首页
    Route::get('/home',"\App\Admin\Controller\HomeController@index");
});