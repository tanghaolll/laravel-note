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

    //个人中心
    public function show(User $user){

        //用户信息 关注，粉丝，文章数
        $user = User::withCount(['stars','fans','posts'])->find($user->id);
        //文章列表
        $posts = $user->posts()->orderBy('created_at','desc')->take(10)->get();
        //关注的用户包含关注，粉丝，文章数
        $star = $user->stars;
        $suser = User::whereIn('id',$star->pluck('star_id'))->withCount(['stars','fans','posts'])->get();

        //粉丝用户包含关注，粉丝，文章数
        $fan = $user->fans;
        $fuser = User::whereIn('id',$fan->pluck('fan_id'))->withCount(['stars','fans','posts'])->get();

        return view('user/show',compact('user','posts','suser','fuser'));
    }
    //关注某人
    public function fan(User $user){

        $me = \Auth::user();
        $me->doFan($user->id);
        return [
            'error'=> 0,
            'msg' => ''
        ];
    }
    //取消关注
    public function unfan(User $user){
        $me = \Auth::user();
        $me->doUnfan($user->id);
        return [
            'error'=> 0,
            'msg' => ''
        ];
    }

}
