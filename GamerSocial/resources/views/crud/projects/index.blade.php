@extends('templates.logged')
@section("links")
    <link rel="stylesheet" href="{{asset("css/app/crud.css")}}">
@endsection
@section('content')
<div class="crud-nav-container">
    @if (Auth::user()->role->id == 1)
        <a href="{{route("user.index")}}">
            <div>Users</div>
        </a>
    @endif
    <a href="{{route("project.index")}}" class="actived">
        <div>Projects</div>
    </a>
    <a href="{{route("post.index")}}">
        <div>Posts</div>
    </a>
    <a href="{{route("file.index")}}">
        <div>Files</div>
    </a>
</div>
<div class="create-btn-container">
    <div></div>
    <form action="{{route("project.index")}}" class="search-form">
        <input type="number" class="rol-select" min="1" name="id" placeholder="Search by user id" value="{{$request->id}}">
        <input maxlength="40" type="text" name="title" placeholder="Search by title" value="{{$request->title}}">
        <button type="submit"><i class="fas fa-2x fa-search"></i></button>
    </form>
</div>
<div class="table-container">
    <table>
        <tr>
            <th>Project</th>
            <th>ID</th>
            <th>Photo</th>
            <th>Title</th>
            <th>User</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
        @foreach ($projects as $project)
            <tr>
                <td><a href="{{route("projectview", $project)}}"><i class="fas fa-2x fa-info-circle info-btn"></i></a></td>
                <td>{{$project->id}}</td>
                <td><img class="img" src="{{asset($project->img)}}" alt=""></td>
                <td>{{$project->title}}</td>
                <td><a href="{{route("profile", $project->user)}}"><img class="img" src="{{asset($project->user->img)}}" alt=""></a></td>
                <td>
                    {{substr($project->created_at, 0,11)}}
                </td>
                <td>
                    <form action="{{route("project.destroy", $project)}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="delete"><i class="fas fa-2x fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
<div class="paginate-controller">     
    {{$projects->appends(Request::except("page"))->links()}}
</div>
@endsection
@section('js')
@endsection