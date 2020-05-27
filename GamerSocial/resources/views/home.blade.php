@extends('templates.logged')
@section("links")
@endsection
@section('content')
<div class="container">
    <div class="post-form-icon-container">
        <i class="fas fa-2x fa-pen-nib post-form-icon"></i>
    </div>
    <div class="post-form hide">
        <form action="{{route("post.create")}}" method="POST">
            @csrf
            <div class="top-post-form">
                <i class="far fa-times-circle fa-2x close-post-form"></i>
            </div>
            <div class="container-post-form">
                <textarea class="post-content-form" placeholder="Write something..." name="text" cols="35" rows="10"></textarea>
                <button class="btn" type="submit">Post</button>
            </div>
        </form>
    </div>
    
    @if (Auth::user()->postFollow()->count()==0)
    <div class="post">
        <div class="post-header">
            <div>
                <img src="{{asset("img/app/icons/iconBlue.svg")}}" alt="">
                <div class="user-name">GamerSocial</div>
            </div>
            <div></div>
        </div>
        <div class="post-body">
            <div class="text-container">Is this empty? Follow someone!</div>
        </div>
    </div>
    @else
        @foreach (Auth::user()->postFollow() as $post)
            <div class="post">
                <div class="post-header">
                    <div>
                        <a href="{{route("profile", $post->user()->first())}}"><img src="{{asset($post->user()->first()->img)}}" alt=""></a>
                        <div class="user-name">{{$post->user()->first()->name}}<span class="date">{{substr($post->created_at, 0,11)}}</span></div>
                    </div>
                    <div>
                        @if ($post->user()->first() == Auth::user())
                            <form action="{{route("post.destroy", $post)}}" method="POST" id="form{{$post->id}}">
                                @csrf
                                @method("DELETE")
                                <input type="hidden" name="profile" value="0">
                                <i class="far fa-times-circle fa-2x delete" onclick="document.getElementById('form{{$post->id}}').submit();"></i>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="post-body">
                    <div class="text-container">{{$post->text}}</div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
@section('js')
@endsection