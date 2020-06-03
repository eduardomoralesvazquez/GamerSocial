@extends('templates.login')
@section('title')
    GamerSocial
@endsection
@section('links')
@endsection
@section('content')
    @error('name')
        <h3 class="error">{{ $message }}</h3>
    @enderror
    @error('password')
        <h3 class="error">{{ $message }}</h3>
    @enderror
    @error('real_name')
        <h3 class="error">{{ $message }}</h3>
    @enderror
    @error('last_name')
        <h3 class="error">{{ $message }}</h3>
    @enderror
    @error('email')
        <h3 class="error">{{ $message }}</h3>
    @enderror
    <a href="{{route("login")}}">
        <img id="icon" src="{{asset("img\app\icons\iconBlue.svg")}}" alt="GamerSocial">            
    </a>       
    <form action="{{route("register")}}" method="POST">
        @csrf
        <input type="text" class="text" name="real_name" id="real_name" placeholder="Name" value="{{ old('real_name') }}" required>
        <input type="text" class="text" name="last_name" id="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
        <input type="text" class="text" name="name" id="name" placeholder="User Name" value="{{ old('name') }}" required>
        <input type="email" class="text" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
        <input class="text password" type="password" name="password" id="password" placeholder="Password" required>
        <input class="text password" type="password" id="password-confirm" placeholder="Repeat Password" name="password_confirmation" required>
        <button type="submit" class="btn">SignUp</button>
        <button type="reset" class="btn">Reset</button>
        <a href="{{route("developer")}}">If you are a developer or a publisher click me</a>
    </form>
@endsection
@section("js")
@endsection