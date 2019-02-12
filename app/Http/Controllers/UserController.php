<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //个人中心
    public  function setting(){
        $user = \Auth::user();
        return view("user/setting",compact("user"));
    }

    //个人操作设置
    public function settingStore(Request $request){
       $this->validate(request(),[
           'name'=> 'required|min:3'
       ]);
       $name = request("name");
       $user = \Auth::user();
       if($name != $user->name){
           if(User::where('name',$name)->count() > 0){
                return back()->withErrors('用户注册名称已经存在');
           }
           $user->name = $name;
       }
       if($request->file('avatar')){
           $path = $request->file('avatar')->storePublicly($user->id);
           $user->avatar = '/storage/' . $path;
       }
       $user->save();
       return back();
    }
}
