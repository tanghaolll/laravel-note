<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/1 0001
 * Time: 16:41
 */

namespace App\Admin\Controller;


class TopicController extends Controller
{
    public  function index(){
        $topics = \App\Topic::all();
            return view("admin/topic/index",compact("topics"));
    }
    public function create(){
        return view("admin/topic/create");

    }
    public function store(){
        $this->validate(request(),[
            "name"=>"required|string"
        ]);
        \App\Topic::create(["name"=>request('name')]);
        return redirect("/admin/topics");
    }
    public function destroy(\App\Topic $topic){
            $topic->delete();
            return [
                'error' => 0,
                'msg' => ''
            ];  
    }

}