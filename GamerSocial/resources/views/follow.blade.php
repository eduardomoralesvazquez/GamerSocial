@extends('templates.logged')
@section("links")
    <link rel="stylesheet" href="{{asset("css/app/profile.css")}}">
    <link rel="stylesheet" href="{{asset("css/app/search.css")}}">
@endsection
@section('content')
<div class="container">
    <div id="profile-box">
        <div id="select">
            <div id="post-btn" class="active">Followers</div>
            <div id="project-btn">Following</div>
        </div>
        <div class="container">
            <div id="post-container">
                @foreach ($followers as $user)
                    <div class="post @if ($user->role_id == 3) hu @endif">
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
                @foreach ($following as $user)
                    <div class="post @if ($user->role_id == 3) hu @endif">
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
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset("js/app/profile.js")}}"></script>
@endsection