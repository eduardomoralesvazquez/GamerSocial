@foreach ($projects as $project)
<div class="post">
    <div class="post-header">
        <div>
            <a href="{{route("projectview", $project)}}"><img src="{{asset($project->img)}}" alt=""></a>
            <div class="user-name">{{$project->title}} by {{$project->user()->first()->name}}<span class="date">{{substr($project->created_at, 0,11)}}</span></div>
        </div>
        <div>
            @if ($project->user()->first() == Auth::user())
                <form action="{{route("projectuser.destroy", $project)}}" method="POST" id="form{{$project->id}}">
                    @csrf
                    @method("DELETE")
                    <input type="hidden" name="origin" value="2">
                    <i class="far fa-times-circle fa-2x delete" onclick="document.getElementById('form{{$project->id}}').submit();"></i>
                </form>
            @endif
        </div>
    </div>
    <a href="{{route("projectview", $project)}}">
        <div class="post-body">
            <div class="text-container">{{$project->summary}}</div>
        </div>
    </a>
</div>
@endforeach