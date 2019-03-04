<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/19 0019
 * Time: 14:48
 */

namespace App\Admin\Controller;


class LoginController extends Controller
{
    public function welcome(){
        return redirect("/login");
    }
    //登陆展示页
    public function index(){
        return view('admin.login.index');
    }
    //登陆逻辑
    public function login(){
        $this->validate(request(),[
            'name'=>'required|min:2',
            'password'=>'required|min:5|max:10',]
           );
        $user = request(["name","password"]);
        if(\Auth::guard('admin')->attempt($user)){
            return redirect("/admin/home");
        }
        return \Redirect::back()->withErrors("用户名密码不正确");

    }
    public function logout(){
        \Auth::guard("admin")->logout();
        return redirect("/admin/login");
    }
}