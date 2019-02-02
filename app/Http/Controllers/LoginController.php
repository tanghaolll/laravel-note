<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登陆页面
    public  function index(){
        return view("login.index");
    }

    //登陆逻辑
    public function register(){
        return null;
    }
    //退出
    public function logout(){
        return null;
    }
}
