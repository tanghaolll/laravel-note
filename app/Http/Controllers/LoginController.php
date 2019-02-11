<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登陆页面
    public  function index(){
        if(\Auth::check()){
            return redirect("/posts");
        }
        return view("login.index");
    }

    //登陆逻辑
    public function login(){
       $this->validate(request(),[
           'email'=>'required|email',
           'password'=>'required|min:5|max:10',
           'is_remember' => 'integer' ]);
       $user = request(["email","password"]);
       $is_rember = boolval(request(["is_remember"]));
       if(\Auth::attempt($user,$is_rember)){
           return redirect("/posts");
       }
       return \Redirect::back()->withErrors("邮箱密码不正确");


    }
    //退出
    public function logout(){
        \Auth::logout();
       return redirect("/login");
    }
}
