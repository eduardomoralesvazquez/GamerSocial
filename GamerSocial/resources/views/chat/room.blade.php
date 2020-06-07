@extends('templates.logged')
@section("links")
<link rel="stylesheet" href="{{asset("css/app/chat.css")}}">
@endsection
@section('content')
<div class="container">
    <div class="chat-container">
        <div class="msg-container">
            <div class="chat">
                @foreach ($room->msgs as $msg)
                    @if ($msg->user_id != $userSend->id)

                        <span class="received msg" >{{$msg->msg}}</span>
                        
                    @else
                        
                        <span class="submited msg" >{{$msg->msg}}</span>
                        
                    @endif
                @endforeach
            </div>
            <form id="send-form">
                @csrf
                <input type="hidden" name="room" value="{{$room->id}}">
                <input type="hidden" name="to" value="{{$user->id}}">
                <input type="hidden" name="from" value="{{$userSend->id}}">
                <input type="text" name="text" class="chat-text">
                <input type="submit" value="Submit" class="submit-btn">
            </form>
            <form id="receive-form" style="display:none">
                <input type="hidden" name="room" value="{{$room->id}}">
                <input type="hidden" name="to" value="{{$user->id}}">
                <input type="hidden" name="from" value="{{$userSend->id}}">
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset("js/app/chat.js")}}"></script>
@endsection