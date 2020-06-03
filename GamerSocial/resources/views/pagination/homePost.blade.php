@foreach ($posts as $post)
<div class="post">
    <div class="post-header">
        <div>
            <a href="{{route("profile", $post->user()->first())}}"><img src="{{asset($post->user()->first()->img)}}" alt=""/></a>
            <div class="user-name">{{$post->user()->first()->name}}<span class="date">{{substr($post->created_at, 0,11)}}</span></div>
        </div>
        <div>
            @if($post->post_id!=null)
                <a href="{{route("thread", $post->post_id)}}"><i class="far fa-2x fa-arrow-alt-circle-up thread"></i></a>
            @endif
            @if($post->project_id!=null)
                <a href="{{route("projectview", $post->project_id)}}"><i class="far fa-2x fa-question-circle thread"></i></a>
            @endif
            @if ($post->user()->first() == Auth::user())
                <form action="{{route("postuser.destroy", $post)}}" method="POST" id="form{{$post->id}}">
                    @csrf
                    @method("DELETE")
                    <input type="hidden" name="origin" value="0"/>
                    <i class="far fa-times-circle fa-2x delete" onclick="document.getElementById('form{{$post->id}}').submit();"></i>
                </form>
            @endif
        </div>
    </div>
    <a href="{{route("thread", $post)}}">
        <div class="post-body">
            <div class="text-container">{{$post->text}}</div>
        </div>
    </a>
</div>
@endforeach