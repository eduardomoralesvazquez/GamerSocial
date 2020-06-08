@extends('templates.login')
@section('title')
    GamerSocial
@endsection
@section('links')
@endsection
@section('content')
            @error('email')
                <h3 class="error">{{ $message }}</h3>
            @enderror
            @error('password')
                <h3 class="error">{{ $message }}</h3>
            @enderror
            <img id="icon" src="{{asset("img\app\icons\iconBlue.svg")}}" alt="GamerSocial">            
            <form action="{{route('login')}}" method="POST">
                @csrf

                <input maxlength="80" class="text" type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" autofocus required>
                <div id="textpass">
                    <input maxlength="40" class="text password" type="password" name="password" id="password" placeholder="Password" required autocomplete="current-password">
                    <div class="btn-show"><i id="show" class="far fa-eye" style="color:white;"></i></div>
                </div>
                <div id="check">
                    <input type="checkbox" name="remember"> Remember me
                </div>
                <button type="submit" class="btn">LogIn</button>
                <a href="{{route("register")}}" class="btn">SignUp</a>
                <a href="{{route("password.request")}}">Forgot Password?</a>
            </form>
@endsection
@section("js")
    <script src="{{asset("js/app/login.js")}}"></script>
@endsection