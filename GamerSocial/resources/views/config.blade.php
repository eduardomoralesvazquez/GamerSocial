@extends('templates.logged')
@section("links")
<link rel="stylesheet" href="{{asset("css/app/config.css")}}">
@endsection
@section('content')
    <div class="container">
        @error('img')
            <h3 class="error">{{ $message }}</h3>
        @enderror
        @error('banner')
            <h3 class="error">{{ $message }}</h3>
        @enderror
        <form class="config-form" method="POST" action="{{route("useruser.update")}}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div>
                <input maxlength="40" type="text" name="name" value="{{Auth::user()->name}}">
            </div>
            <div>
                <textarea maxlength="1000" name="description" id="description" cols="30" rows="5">{{Auth::user()->description}}</textarea>
            </div>
            <div class="file">
                Perfil <label for="img"><i class="fas fa-2x fa-upload upload"></i></label><input type="file" name="img" id="img">
            </div>
            <div class="file">
                Banner <label for="banner"><i class="fas fa-2x fa-upload upload"></i></label><input type="file" name="banner" id="banner">
            </div>
            <button class="btn" type="submit">Submit</button>
            <a class="btn" href="{{route("password.request")}}">Change Password</a>
        </form>
    </div>
@endsection
@section('js')
@endsection