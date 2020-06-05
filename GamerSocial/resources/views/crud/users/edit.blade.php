@extends('templates.logged')
@section("links")
<link rel="stylesheet" href="{{asset("css/app/config.css")}}">
@endsection
@section('content')
    <div class="container">
        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{$item}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="config-form" method="POST" action="{{route("user.update", $user)}}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div>
                <input type="text" name="name" value="{{$user->name}}">
            </div>
            <div>
                <input type="text" name="real_name" value="{{$user->real_name}}">
            </div>
            <div>
                <input type="text" name="last_name" value="{{$user->last_name}}">
            </div>
            <div>
                <input type="email" name="email" value="{{$user->email}}">
            </div>
            <div>
                <input type="password" name="password" placeholder="Password">
            </div>
            <div>
                <textarea name="description" id="description" cols="30" rows="5" required>{{$user->description}}</textarea>
            </div>
            <div class="file">
                Perfil <label for="img"><i class="fas fa-2x fa-upload upload"></i></label><input type="file" name="img" id="img">
            </div>
            <div class="file">
                Banner <label for="banner"><i class="fas fa-2x fa-upload upload"></i></label><input type="file" name="banner" id="banner">
            </div>
            <div>
                Roles
                <select name="role_id" id="role_id" required>
                    @foreach ($roles as $rol)
                        @if ($rol->name != "administrator")
                            @if ($rol->name == $user->role->name)
                                <option value="{{$rol->id}}" selected>{{$rol->name}}</option>                            
                            @else
                                <option value="{{$rol->id}}">{{$rol->name}}</option>                
                            @endif
                        @endif
                    @endforeach
                </select>
            </div>
            <button class="btn" type="submit">Submit</button>
        </form>
    </div>
@endsection
@section('js')
@endsection