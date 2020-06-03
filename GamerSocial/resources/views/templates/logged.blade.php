<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>GamerSocial</title>
    <link rel="stylesheet" href="{{asset("css/app/index.css")}}"/>
    <link rel="stylesheet" href="{{asset("css/app/style.css")}}"/>
    <link rel="stylesheet" href="{{asset("css/fontawesome/css/all.css")}}"/>
    @yield("links")
    <link rel="icon" type="image/png" href="{{asset("img/app/icons/iconBlue.svg")}}"/>
</head>
<body>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div id="dark"></div>
    <div id="menu" class="hide-menu">
        <div>
            <a href="{{route("profile", Auth::user())}}">{{Auth::user()->name}}</a>
            <a href="#">Chats</a>
            <a href="{{route("user.config")}}">Config</a>
            <a href="{{route("follows")}}">Follow</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LogOut</a>
            <a href="#" id="close-menu"><i class="fas fa-arrow-left"></i></a>
        </div>
        <div>
            <img src="{{asset("img/app/icons/iconWhite.svg")}}" alt="">
            <p>GamerSocial</p>
        </div>
    </div>
    <nav>
        <div id="option">
            <div id="menu-btn"><img src="{{asset("img/app/icons/burguerWhite.svg")}}" alt="">
                <div class="notif">
                    <div></div>
                </div>
            </div>
            <div><a href="{{route("home")}}"><img src="{{asset("img/app/icons/iconWhite.svg")}}" alt=""></a></div>
            <div><a href="{{route("project")}}"><img src="{{asset("img/app/icons/devWhite.svg")}}" alt=""></a></div>
            <div><a href="{{ route('search') }}"><img src="{{asset("img/app/icons/searchWhite.svg")}}" alt=""></a></div>
        </div>
    </nav>
    @yield("content")
    <script src="{{asset("js/app/index.js")}}"></script>
    @yield("js")
</body>
</html>