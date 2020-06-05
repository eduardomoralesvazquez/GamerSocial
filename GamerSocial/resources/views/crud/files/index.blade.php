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
    <a href="{{route("project.index")}}">
        <div>Projects</div>
    </a>
    <a href="{{route("post.index")}}">
        <div>Posts</div>
    </a>
    <a href="{{route("file.index")}}" class="actived">
        <div>Files</div>
    </a>
</div>
<div class="create-btn-container">
    <div></div>
    <form action="{{route("file.index")}}" class="search-form">
        <input type="number" class="rol-select" min="1" name="id" placeholder="Search by user id" value="{{$request->id}}">
        <button type="submit"><i class="fas fa-2x fa-search"></i></button>
    </form>
</div>
<div class="table-container">
    <table>
        <tr>
            <th>To Project</th>
            <th>ID</th>
            <th>Image</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
        @foreach ($files as $file)
            <tr>
                <td><a href="{{route("projectview", $file->project_id)}}"><i class="fas fa-2x fa-info-circle info-btn"></i></a></td>
                <td>{{$file->id}}</td>
                <td><img class="img" src="{{asset($file->route)}}" alt=""></td>
                <td>
                    {{substr($file->created_at, 0,11)}}
                </td>
                <td>
                    <form action="{{route("file.destroy", $file)}}" method="POST">
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
    {{$files->appends(Request::except("page"))->links()}}
</div>
@endsection
@section('js')
@endsection