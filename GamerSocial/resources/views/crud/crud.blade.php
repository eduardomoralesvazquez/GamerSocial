@extends('templates.logged')
@section("links")
    <link rel="stylesheet" href="{{asset("css/app/crud.css")}}">
@endsection
@section('content')
<div class="crud-nav-container">
    @if (Auth::user()->role->id == 1)
        <a href="{{route("user.index")}}">
            <div>Users</div>
        </a>
    @endif
    <a href="{{route("project.index")}}">
        <div>Projects</div>
    </a>
    <a href="{{route("post.index")}}">
        <div>Posts</div>
    </a>
    <a href="{{route("file.index")}}">
        <div>Files</div>
    </a>
</div>
@endsection
@section('js')
@endsection