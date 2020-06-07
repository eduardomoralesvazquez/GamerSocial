@extends('templates.logged')
@section("links")
<link rel="stylesheet" href="{{asset("css/app/chat.css")}}">
@endsection
@section('content')
<div class="container">
    <div class="chat-container">
        <div class="contact">
            @foreach ($friends as $friend)
            <a href="{{route("room", $friend)}}">
                <div class="display">
                        <div class="profile">
                            <img class="profile-img" src="{{asset($friend->img)}}" alt="">{{$friend->name}}
                        </div>
                    <i class="arrow fas fa-arrow-right"></i>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection