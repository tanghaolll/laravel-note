<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 列表
    public function index() {
        $posts = Post::orderby("created_at","desc")->paginate(6);
        return view("post/index", compact('posts'));
    }

    // 详情页面
    public function show(Post $post) {
        return view('post/show',compact("post"));
    }

    // 创建页面
    public function create() {
        return view('post/create');

    }

    // 创建逻辑
    public function store() {
        $this->validate(request(),[
            'title' => 'required|String|max:255|min:5',
            'content' => 'required|String|min:10'
            ]);
       $post =  Post::create(request(["title","content"]));

       return redirect("/posts");
    }

    // 编辑页面
    public function edit(Post $post) {
        return view('post/edit', compact('post'));
    }

    // 编辑逻辑
    public function update(Post $post) {
        $this->validate(request(),
            [
                'title' => 'required|String|max:255|min:5',
                'content' => 'required|String|min:25'
            ]);
        $post->title = request("title");
        $post->content = request("content");
        $post->save();
        return redirect("/posts/{$post->id}");
    }

    // 删除逻辑
    public function delete(Post $post) {
        //todo 权限是否位作者
        $post->delete();
        return redirect("/posts");
    }
    //图片上传
    public function imageUpload(Request $request){
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/' . $path);

    }
}
