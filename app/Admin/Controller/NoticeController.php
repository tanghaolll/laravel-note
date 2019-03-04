<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/1 0001
 * Time: 16:41
 */

namespace App\Admin\Controller;


class NoticeController extends Controller
{
    public  function index(){
        $notices = \App\Notice::all();
            return view("admin/notice/index",compact("notices"));
    }
    public function create(){
        return view("admin/notice/create");

    }
    public function store(){
        $this->validate(request(),[
            "title"=>"required|string",
            "content"=>"required|string",
        ]);
        $notice = \App\Notice::create(request(["titile","content"]));
        dispatch(new \App\Jobs\SendMessage($notice));

        return redirect("/admin/notices");
    }


}