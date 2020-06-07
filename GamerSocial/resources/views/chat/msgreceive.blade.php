@foreach ($received as $msg)
    <span class="received msg" >{{$msg->msg}}</span>
@endforeach