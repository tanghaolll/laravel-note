<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/21 0021
 * Time: 16:25
 */

namespace App\Admin\Controller;


class PermissionController extends Controller
{
    //权限列表页面
    public function index(){
        return view("/admin/permission/index");
    }
    //创建权限页面
    public function create(){
        return view("/admin/permission/add");
    }
    //创建权限的实际行为
    public function store(){

    }

}