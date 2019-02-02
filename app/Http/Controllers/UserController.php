<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //个人中心
    public  function setting(){
        return view("user/setting");
    }

    //个人操作设置
    public function settingStore(){
        return null;
    }
}
