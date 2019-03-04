<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Zan;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 列表
    public function index() {
        $posts = Post::orderby("created_at","desc")->withCount(['comments','zans'])->with('user')->paginate(6);

        return view("post/index", compact('posts'));
    }

    // 详情页面
    public function show(Post $post) {
        $post->load('comments');
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
        $user_id = \Auth::id();
        $params = array_merge(request(["title","content"]),compact("user_id"));
       $post =  Post::create($params);

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
        $this->authorize('update',$post);
        $post->title = request("title");
        $post->content = request("content");
        $post->save();
        return redirect("/posts/{$post->id}");
    }

    // 删除逻辑
    public function delete(Post $post) {
        //todo 权限是否位作者
        $this->authorize('delete',$post);
        $post->delete();
        return redirect("/posts");
    }
    //图片上传
    public function imageUpload(Request $request){
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/' . $path);

    }
    //评论
    public function comment(Post $post){

        $this->validate(request(),
            [
                'content' => 'required|String|min:3'
            ]);
        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = request('content');

        $post->comments()->save($comment);
      return back();
    }
    //点赞
    public function zan(Post $post){

        $param = [
            'user_id' => \Auth::id(),
            'post_id' =>$post->id,
        ];
        Zan::firstOrCreate($param);
        return back();

    }
    //取消赞
    public function unzan(Post $post){
            $post->zan(\Auth::id())->delete();
                return back();
    }
    public  function search(){
        $this->validate(request(),[
            'query' => 'required'
        ]);
        $query = request("query");
        $posts = \App\Post::search($query)->paginate(2);

        return view("post/search",compact('posts','query'));
    }
}
