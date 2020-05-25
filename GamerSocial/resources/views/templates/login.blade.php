<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="{{asset("img/app/icons/iconBlue.svg")}}"/>
    <title>@yield("title")</title>
    <link rel="stylesheet" href="{{asset("css/app/style.css")}}"/>
    <link rel="stylesheet" href="{{asset("css/app/login.css")}}"/>
    <link rel="stylesheet" href="{{asset("css/fontawesome/css/all.css")}}"/>
    @yield('links')
</head>
<body>
    <div id="back">
        <div id="login">
            @yield("content")
        </div>
    </div>
    <script>
        let img = ["key", "game", "productsetup", "setup", "woodnote"];
        window.onload = ()=>{
            start();
        }
        function start(){
            if(document.querySelector(".btn-show") != undefined){
            document.querySelector(".btn-show").addEventListener("click", (e)=>{
                e.preventDefault();
                changePass()
            });}
            document.body.style.backgroundImage = "url(<?php echo asset('img/app/background/')?>/"+img[Math.floor(Math.random()*5)]+".jpg)";
        }
    </script>
    @yield("js")
</body>
</html>