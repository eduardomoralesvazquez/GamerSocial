
@foreach ($users as $user)
<div class="post @if ($user->role_id == 3) hu @endif">
    <div class="post-header">
        <div>
            <a href="{{route("profile", $user)}}"><img src="{{asset($user->img)}}" alt=""></a>
            <div class="user-name">{{$user->name}}<span class="date">{{substr($user->created_at, 0,11)}}</span></div>
        </div>
        <div>
        </div>
    </div>
    <div class="post-body">
        <div class="text-container">{{$user->description}}</div>
    </div>
</div>
@endforeach