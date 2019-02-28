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
        Route::get("/users/{user}/role","\App\Admin\Controller\UserController@role");
        Route::post("/users/{user}/role","\App\Admin\Controller\UserController@storeRole");
        //审核模块
        Route::get('/posts',"\App\Admin\Controller\PostController@index");
        Route::post('/posts/{post}/status',"\App\Admin\Controller\PostController@status");
        //角色
        Route::get('/roles',"\App\Admin\Controller\RoleController@index");
        Route::get('/roles/create',"\App\Admin\Controller\RoleController@create");
        Route::post('/roles/store',"\App\Admin\Controller\RoleController@store");
        Route::get("/roles/{role}/permission","\App\Admin\Controller\RoleController@permission");
        Route::post("/roles/{role}/permission","\App\Admin\Controller\RoleController@storePermission");
        Route::post("/roles/{role}/role","\App\Admin\Controller\RoleController@storePermission");
        //权限
        Route::get('/permissions',"\App\Admin\Controller\PermissionController@index");
        Route::get('/permissions/create',"\App\Admin\Controller\PermissionController@create");
        Route::post('/permissions/store',"\App\Admin\Controller\PermissionController@store");


    });

});