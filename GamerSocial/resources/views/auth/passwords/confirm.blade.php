@extends('templates.login')
@section('title')
    GamerSocial
@endsection
@section('links')
@endsection
@section('content')
    @error('password')
        <h3 class="error">{{ $message }}</h3>
    @enderror
    <a href="{{route("login")}}">
        <img id="icon" src="{{asset("img\app\icons\iconBlue.svg")}}" alt="GamerSocial">            
    </a>       
    <form action="{{route("password.confirm")}}" method="POST">
        @csrf
        <h3 class="center-label">Please confirm your password before continuing</h3>
        <input class="text password" type="password" name="password" id="password" placeholder="Password" required>
        <button type="submit" class="btn">Confirm Password</button>
        <a href="{{route("password.request")}}">Forgot Password?</a>
    </form>
@endsection
@section("js")
@endsection