<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //个人中心
    public  function setting(){
        $user = \Auth::user();
        return view("user/setting",compact("user"));
    }

    //个人操作设置
    public function settingStore(){
       $this->validate(request(),[
           'name'=> 'required|min:3'
       ]);
       $name = request("name");
       $user = \Auth::user();
       if($name != $user->name){
           
       }
    }
}
