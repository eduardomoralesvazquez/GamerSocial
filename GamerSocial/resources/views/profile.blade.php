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
                <div><a href="#"><i class="fas fa-4x fa-cog"></i></a></div>
            @else
                @if (Auth::user()->following($user))
                
                    <form id="unfollow" action="{{ route('follow.destroy', Auth::user()->follow()->where("followed", $user->id)->first())}}" method="POST" style="display: none;">
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
    
                    <div><a href="{{route("follow.create", $user)}}"><i class="fas fa-4x fa-user-friends"></i></a></div>

                @endif
                @if(Auth::user()->friends($user))

                    <div><a href="#"><i class="fas fa-4x fa-comments"></i></a></div>

                @endif
            @endif
        </div>
        <div id="description">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Animi expedita eius explicabo debitis facere, aspernatur aperiam cum nobis similique ut nemo reprehenderit qui perferendis dolores! Repellendus facilis nemo aperiam asperiores.
        </div>
        <div id="select">
            <div id="post-btn">Post</div>
            <div id="project-btn">Project</div>
        </div>
        <div class="container">
            <div id="post-container" class="hide">
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
                        <div class="text-container">there are no posts @if($user == Auth::user()) ?, why do not you post something! @endif</div>
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
                                    @if ($user == Auth::user())
                                        <form action="{{route("post.destroy", $post)}}" method="POST" id="form{{$post->id}}">
                                            @csrf
                                            @method("DELETE")
                                            <input type="hidden" name="profile" value="1">
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
            <div id="project-container" class="hide">
                <div class="post">
                    <div class="post-header">
                        <div>
                            <img src="{{asset("img/users/default.jpg")}}" alt="">
                            <div class="user-name">Ramir15</div>
                        </div>
                        <div><i class="far fa-times-circle fa-2x delete"></i></div>
                    </div>
                    <div class="post-body">
                        <div class="text-container">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit quibusdam quidem explicabo eveniet autem, repellat ea, expedita, ratione dolorum accusantium quaerat enim. Magnam, pariatur numquam. Repudiandae perferendis illo facere at.</div>
                    </div>
                </div>
                <div class="post">
                    <div class="post-header">
                        <div>
                            <img src="{{asset("img/users/default.jpg")}}" alt="">
                            <div class="user-name">Ramir15</div>
                        </div>
                        <div><i class="far fa-times-circle fa-2x delete"></i></div>
                    </div>
                    <div class="post-body">
                        <div class="text-container">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit quibusdam quidem explicabo eveniet autem, repellat ea, expedita, ratione dolorum accusantium quaerat enim. Magnam, pariatur numquam. Repudiandae perferendis illo facere at.</div>
                    </div>
                </div>
                <div class="post">
                    <div class="post-header">
                        <div>
                            <img src="{{asset("img/users/default.jpg")}}" alt="">
                            <div class="user-name">Ramir15</div>
                        </div>
                        <div><i class="far fa-times-circle fa-2x delete"></i></div>
                    </div>
                    <div class="post-body">
                        <div class="text-container">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit quibusdam quidem explicabo eveniet autem, repellat ea, expedita, ratione dolorum accusantium quaerat enim. Magnam, pariatur numquam. Repudiandae perferendis illo facere at.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset("js/app/profile.js")}}"></script>
@endsection