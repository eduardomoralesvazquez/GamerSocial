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
    @if (session('resent'))
    <h3 class="success">A fresh verification link has been sent to your email address.</h3>
    @endif
    <form action="{{route('verification.resend')}}" method="POST">
        @csrf
        <span class="center-label">Verify your Email Address, before proceeding, please check your email for a verification link. If you did not receive the email. </span>
        <button type="submit" class="btn">click here to request another</button>
    </form>
@endsection
@section("js")
    <script src="{{asset("js/app/login.js")}}"></script>
@endsection