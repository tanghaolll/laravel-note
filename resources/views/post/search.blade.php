

@extends("layout.main")
@section("content")


        <div class="alert alert-success" role="alert">
            下面是搜索"{{$query}}"出现的文章，共{{$posts->total()}}条
        </div>

        <div class="col-sm-8 blog-main">
            @foreach($posts as $value)
                <div class="blog-post">
                    <h2 class="blog-post-title"><a href="/posts/{{$value->id}}" >{{$value->title}}</a></h2>
                    <p class="blog-post-meta">{{$value->created_at->toFormattedDateString()}}  by <a href="/user/{{$value->user->id}}">{{$value->user->name}}</a></p>

                    <p>{!!str_limit($value->content,100,'...')!!}</p>
                    <p class="blog-post-meta">赞 {{$value->zans_count}}   | 评论 {{$value->comments_count}}</p>
                </div>
            @endforeach
                {{$posts->links()}}
        </div><!-- /.blog-main -->

@endsection
