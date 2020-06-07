@extends('templates.logged')
@section("links")
@endsection
@section('content')
<div class="container">
    <div class="post-form-icon-container" >
        <i class="fas fa-2x fa-pen-nib post-form-icon"></i>
    </div>
    <div class="post-form hide">
        <form action="{{route("postuser.create")}}" method="POST">
            @csrf            
            <input type="hidden" name="origin" value="0">
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
            <div class="post @if ($post->user->role_id == 3) hu @endif">
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
    @endif
</div>
@endsection
@section('js')
<script src="{{asset("js/pagination/home.js")}}"></script>
@endsection