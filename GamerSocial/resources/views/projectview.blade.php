@extends('templates.logged')
@section("links")
<link rel="stylesheet" href="{{asset("css/app/projectview.css")}}">
@endsection
@section('content')
<div class="container">
    <div class="post-form-icon-container">
        <i class="fas fa-2x fa-pen-nib post-form-icon"></i>
    </div>
    <div class="post-form hide">
        <form action="{{route("postuser.create")}}" method="POST">
            @csrf            
            <input type="hidden" name="origin" value="2">
            <input type="hidden" name="project" value="{{$project->id}}">
            <div class="top-post-form">
                <i class="far fa-times-circle fa-2x close-post-form"></i>
            </div>
            <div class="container-post-form">
                <textarea maxlength="1000" class="post-content-form" placeholder="Write something..." name="text" cols="35" rows="10"></textarea>
                <button class="btn" type="submit">Post</button>
            </div>
        </form>
    </div>
    <img src="{{asset($project->img)}}" class="img-project" alt="">
    <hr/>
    <h3>{{$project->title}}</h3>
    <hr/>
    <h3>
        DESCRIPTION
    </h3>
    <div class="summary">{{$project->summary}}</div>
    <h3>
        AUTHOR
    </h3>
    <a href="{{route("profile", $project->user)}}"><img src="{{asset($project->user->img)}}" class="img-author" alt=""></a>
    {{$project->user->name}}
    <h3>
        GALLERY
    </h3>
    <div class="img-container">
        @if ($project->files->count() == 0)
            <div><img src="{{asset("img/projects/galleries/sadkitty.jpg")}}" alt=""></div>
        @endif
        @foreach ($project->files as $file)
            <div><img src="{{asset($file->route)}}" alt=""></div>
        @endforeach
    </div>
    @if($project->link)
        <h3>Link to Project</h3>
        <a href="{{$project->link}}"><i class="fas fa-2x fa-link link-icon"></i></a>
    @endif
    <hr/>
    <h3>COMMENT</h3>
    @foreach ($project->posts as $post)
        <div class="post">
            <div class="post-header">
                <div>
                    <a href="{{route("profile", $post->user()->first())}}"><img src="{{asset($post->user()->first()->img)}}" alt=""/></a>
                    <div class="user-name">{{$post->user()->first()->name}}<span class="date">{{substr($post->created_at, 0,11)}}</span></div>
                </div>
                <div>
                    @if ($post->user()->first() == Auth::user())
                        <form action="{{route("postuser.destroy", $post)}}" method="POST" id="form{{$post->id}}">
                            @csrf
                            @method("DELETE")
                            <input type="hidden" name="origin" value="2"/>
                            <input type="hidden" name="project" value="{{$project->id}}"/>
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
</div>
@endsection
@section('js')
<script src="{{asset("js/app/projectview.js")}}"></script>
@endsection