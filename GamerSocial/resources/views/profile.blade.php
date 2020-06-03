@extends('templates.logged')
@section("links")
    <link rel="stylesheet" href="{{asset("css/app/profile.css")}}">
@endsection
@section('content')
<div class="container">
    <div id="profile-box">
        <img src="{{asset($user->banner)}}" id="banner" alt="">
        <div id="photo-container">
            <img src="{{asset($user->img)}}" id="profile-photo" alt="">
        </div>
        <span>{{$user->name}}</span>
        <div id="info">
            @if (Auth::user() == $user)
                <div><a href="{{route("user.config")}}"><i class="fas fa-4x fa-cog"></i></a></div>
            @else
                @if (Auth::user()->following($user))
                
                    <form id="unfollow" action="{{ route('followuser.destroy', Auth::user()->follow()->where("followed", $user->id)->first())}}" method="POST" style="display: none;">
                        @csrf
                        @method("DELETE")
                    </form>
                    <div>
                        <a href="#"
                            onclick="event.preventDefault();
                            document.getElementById('unfollow').submit();"
                        >
                            <i class="fas fa-4x fa-user-slash"></i>
                        </a>
                    </div>
        
                @else
    
                    <div><a href="{{route("followuser.create", $user)}}"><i class="fas fa-4x fa-user-friends"></i></a></div>

                @endif
                @if(Auth::user()->friends($user))

                    <div><a href="#"><i class="fas fa-4x fa-comments"></i></a></div>

                @endif
            @endif
        </div>
        <div id="description">
            {{Auth::user()->description}}
        </div>
        <div id="select">
            <div id="post-btn" class="active">Post</div>
            <div id="project-btn">Project</div>
        </div>
        <div class="container">
            <div id="post-container" >
                @if ($user->post()->count()==0)
                <div class="post">
                    <div class="post-header">
                        <div>
                            <img src="{{asset("img/app/icons/iconBlue.svg")}}" alt="">
                            <div class="user-name">GamerSocial</div>
                        </div>
                        <div></div>
                    </div>
                    <div class="post-body">
                        <div class="text-container">there are no posts @if($user == Auth::user()) , why do not you post something! @endif</div>
                    </div>
                </div>
                @else
                    @foreach ($user->post()->orderBy("created_at","desc")->get() as $post)
                        <div class="post">
                            <div class="post-header">
                                <div>
                                    <img src="{{asset($post->user()->first()->img)}}" alt="">
                                    <div class="user-name">{{$post->user()->first()->name}}<span class="date">{{substr($post->created_at, 0,11)}}</span></div>
                                </div>
                                <div>
                                    @if($post->project_id!=null)
                                        <a href="{{route("projectview", $post->project_id)}}"><i class="far fa-2x fa-question-circle thread"></i></a>
                                    @endif
                                    @if($post->post_id!=null)
                                        <a href="{{route("thread", $post->post_id)}}"><i class="far fa-2x fa-arrow-alt-circle-up thread"></i></a>
                                    @endif
                                    @if ($user == Auth::user())
                                        <form action="{{route("postuser.destroy", $post)}}" method="POST" id="form{{$post->id}}">
                                            @csrf
                                            @method("DELETE")
                                            <input type="hidden" name="origin" value="1">
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
            <div id="project-container" class="hide">
                @if ($user->projects->count()==0)
                <div class="post">
                    <div class="post-header">
                        <div>
                            <img src="{{asset("img/app/icons/iconBlue.svg")}}" alt="">
                            <div class="user-name">GamerSocial</div>
                        </div>
                        <div></div>
                    </div>
                    <div class="post-body">
                        <div class="text-container">This is empty @if($user->id == Auth::user()->id) , Create something! @endif </div>
                    </div>
                </div>
                @else
                    @foreach ($user->projects->sortByDesc("created_at") as $project)
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
                                            <input type="hidden" name="origin" value="1">
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
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset("js/app/profile.js")}}"></script>
@endsection