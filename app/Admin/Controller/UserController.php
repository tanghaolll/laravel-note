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
}