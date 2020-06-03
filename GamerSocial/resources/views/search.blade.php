@extends('templates.logged')
@section("links")
    <link rel="stylesheet" href="{{asset("css/app/profile.css")}}">
    <link rel="stylesheet" href="{{asset("css/app/search.css")}}">
@endsection
@section('content')
<div class="container">
    <form action="search" method="GET" class="search-form">
        <input type="text" name="search" id="search" placeholder="search" class="search-text">
        <button type="submit" class="btn search-btn"><i class="fas fa-2x fa-search search-icon"></i></button>
    </form>
    <div id="profile-box">
        <div id="select">
            <div id="post-btn" class="active">Users</div>
            <div id="project-btn">Projects</div>
        </div>
        <div class="container">
            <div id="post-container">
                @foreach ($users as $user)
                    <div class="post">
                        <div class="post-header">
                            <div>
                                <a href="{{route("profile", $user)}}"><img src="{{asset($user->img)}}" alt=""></a>
                                <div class="user-name">{{$user->name}}<span class="date">{{substr($user->created_at, 0,11)}}</span></div>
                            </div>
                            <div>
                            </div>
                        </div>
                        <div class="post-body">
                            <div class="text-container">{{$user->description}}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="project-container" class="hide">
                @foreach ($projects as $project)
                <div class="post">
                    <div class="post-header">
                        <div>
                            <a href="{{route("projectview", $project)}}"><img src="{{asset($project->img)}}" alt=""></a>
                            <div class="user-name">{{$project->title}} by {{$project->user()->first()->name}}<span class="date">{{substr($project->created_at, 0,11)}}</span></div>
                        </div>
                        <div>
                            @if ($project->user()->first() == Auth::user())
                                <form action="{{route("projectuser.destroy", $project)}}" method="POST" id="form{{$project->id}}">
                                    @csrf
                                    @method("DELETE")
                                    <input type="hidden" name="origin" value="2">
                                    <i class="far fa-times-circle fa-2x delete" onclick="document.getElementById('form{{$project->id}}').submit();"></i>
                                </form>
                            @endif
                        </div>
                    </div>
                    <a href="{{route("projectview", $project)}}">
                        <div class="post-body">
                            <div class="text-container">{{$project->summary}}</div>
                        </div>
                    </a>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset("js/app/profile.js")}}"></script>
<script src="{{asset("js/pagination/search.js")}}"></script>
@endsection