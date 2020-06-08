@extends('templates.login')
@section('title')
    GamerSocial
@endsection
@section('links')
@endsection
@section('content')
    <a href="{{route("login")}}">
        <img id="icon" src="{{asset("img\app\icons\iconBlue.svg")}}" alt="GamerSocial">            
    </a>
    @error('email')
    <h3 class="error">{{$message}}</h3>
    @enderror
    @if (session("status"))
    <h3 class="success">{{session('status')}}</h3>
    @endif
    <form action="{{route('password.email')}}" method="POST">
        @csrf
        <span class="center-label">Please enter your email</span>
        <input maxlength="80" class="text" type="email" id="email" name="email" placeholder="Email" autofocus required/>
        <button type="submit" class="btn">Send Pasword Reset Link</button>
    </form>
@endsection
@section("js")
    <script src="{{asset("js/app/login.js")}}"></script>
@endsection