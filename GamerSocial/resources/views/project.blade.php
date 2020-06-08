@extends('templates.logged')
@section("links")
<link rel="stylesheet" href="{{asset("css/app/project.css")}}">
@endsection
@section('content')
@if($errors->any())
    <div class="error">
        <ul>
            @foreach ($errors->all() as $item)
                <li>{{$item}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <div class="project-form-icon-container">
        <i class="fas fa-2x fa-plus project-form-icon"></i>
    </div>
    <div class="project-form hide">
        <form action="{{route("projectuser.create")}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="top-project-form">
                <i class="far fa-times-circle fa-2x close-project-form"></i>
            </div>
            <div class="container-project-form">
                <div class="title-container">
                    <input maxlength="40" type="text" name="title" class="title" id="title" placeholder="What is the name of your project?">
                </div>
                <div class="file">
                    Project image <label for="img"><i class="fas fa-2x fa-upload upload"></i></label><input type="file" name="img" id="img">
                </div>
                <div class="file">
                    Gallery <label for="files"><i class="fas fa-2x fa-upload upload"></i></label><input type="file" name="files[]" id="files" multiple>
                </div>
                <div class="summary-container">
                    <textarea maxlength="1000" class="project-content-form" placeholder="What is your project about?" row="auto" name="summary"></textarea>
                </div>
                <div class="title-container">
                    <input maxlength="300" type="text" name="link" class="title" id="link" placeholder="Is not enough with images?, link your project!">
                </div>
                <button class="btn" type="submit">Make Project</button>
            </div>
        </form>
    </div>
    
    @if ($projects->count()==0)
    <div class="post">
        <div class="post-header">
            <div>
                <img src="{{asset("img/app/icons/iconBlue.svg")}}" alt="">
                <div class="user-name">GamerSocial</div>
            </div>
            <div></div>
        </div>
        <div class="post-body">
            <div class="text-container">Is this empty? Create something!</div>
        </div>
    </div>
    @else
        @foreach ($projects as $project)
            <div class="post @if ($project->user->role_id == 3) hu @endif">
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
                                <input type="hidden" name="origin" value="0">
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
    @endif
</div>
@endsection
@section('js')
<script src="{{asset("js/pagination/project.js")}}"></script>
@endsection