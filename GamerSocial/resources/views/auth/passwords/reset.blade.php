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
    <form action="{{route('password.update')}}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input class="text" type="email" id="email" name="email" placeholder="Email" value="{{ $email ?? old('email') }}" autofocus required/>
        <input id="password" type="password" class="text" name="password" required>
        <input id="password-confirm" type="password" class="text" name="password_confirmation" required>

        <button type="submit" class="btn">Reset Password</button>
    </form>
@endsection
@section("js")
    <script src="{{asset("js/app/login.js")}}"></script>
@endsection