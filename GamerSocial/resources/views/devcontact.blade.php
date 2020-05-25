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
    <h3 class="center-label">If you are a dev or a publisher, please contact with us by phone in 950 999 999 or by email gamersocialverified@gmail.com</h3>
@endsection
@section("js")
    <script src="{{asset("js/app/login.js")}}"></script>
@endsection