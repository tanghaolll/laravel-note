<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/21 0021
 * Time: 16:25
 */

namespace App\Admin\Controller;


class RoleController extends Controller
{
    //角色列表
    public function index()
    {
        $roles = \App\AdminRole::paginate(10);
        return view('admin.role.index',compact('roles'));
    }
    //创建角色
    public function create()
    {
        return view('admin.role.add');
    }
    // 创建角色行为
    public function store()
    {
        $this->validate(request(),[
            'name' => 'required|min:3',
            'description' => 'required'
        ]);
        \App\AdminRole::create(request(['name','description']));
        return redirect('/admin/roles');

    }
    // 角色跟权限的关系页面
    public function permission(\App\AdminRole $role)
    {
        //获取所有权限
        $permissions = \App\AdminPermission::all();
        //获取当前用户的权限
        $myPermissions = $role->permissions;
        return view("admin.role.permission",compact('permissions','myPermissions','role'));
    }
    //储存角色权限关系行为
    public function storePermission(\App\AdminRole $role)
    {
        //验证传过来的参数
        $this->validate(request(),[
            'permissions'=>'required|array'
        ]);
        $permissions = \App\AdminPermission::findMany(request('permissions'));
        $myPermissions = $role->permissions;
        // 要增加的
        $addPermissions = $permissions->diff($myPermissions);
        foreach ($addPermissions as $permission) {
            $role->grantPermission($permission);
        }
        // 要删除的
        $deletePermissions = $myPermissions->diff($permissions);
        foreach ($deletePermissions as $permission) {
            $role->deletePermission($permission);
        }
        return back();
    }
}