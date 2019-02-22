<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/19 0019
 * Time: 13:58
 */

namespace App\Admin\Controller;


use App\AdminUser;
use function GuzzleHttp\Promise\queue;

class UserController extends Controller
{
    public function index(){
        $users = AdminUser::paginate(10);
        return view("/admin/user/index",compact('users'));
    }
    public function create(){
        return view("/admin/user/add");
    }
    public function store(){
        $this->validate(request(),[
            'name'=> "required|min:3",
            'password' =>"required"
        ]);
        $name = request("name");
        $password = bcrypt(request("password"));
        AdminUser::create(compact("name","password"));
        return redirect("/admin/users");
    }
    //用户角色页面
    public function role(AdminUser $user){
        $roles = \App\AdminRole::all();
        $myRoles  = $user->roles();
        return view("admin/user/role",compact("roles","myRoles",'user'));
    }
    //储存用户角色
    public function storeRole(AdminUser $user){

        $this->validate(request(),[
           'roles' => 'required|array'
        ]);
        $roles = \App\AdminRole::findMany(request('roles'));
        $myRoles = $user->roles();
        //要增加
        $addRoles = $roles->diff($myRoles);
        foreach ($addRoles as $role){
            $user->assignRole($role);
        }
        //要删除
        $deleteRoles = $myRoles->diff($roles);
        foreach ($deleteRoles as $role){
            $user->deleteRole($role);
        }

    }
}