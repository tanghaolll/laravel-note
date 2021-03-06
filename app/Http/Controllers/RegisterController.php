<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //注册页面
    public  function index(){
        return view("register/index");
    }

    //注册逻辑
    public function register(){
        $this->validate(request(),[
           'name' => 'required|min:3|unique:users,name',
            'email'=>'required|unique:users,email|email',
            'password'=>'required|min:5|max:10|confirmed'
        ]);
     /*   $user = new User();
        $user->name = request("name");
        $user->email = request("email");
        $user->password = request("password");
        $user->save();*/
        $name = request("name");
        $email = request("email");
        $password = bcrypt(request("password"));
        $user = User::create(compact('name','email','password'));
        return redirect("/login");
    }
}
