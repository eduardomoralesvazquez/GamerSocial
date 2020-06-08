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
    <a href="{{route("post.index")}}" class="actived">
        <div>Posts</div>
    </a>
    <a href="{{route("file.index")}}">
        <div>Files</div>
    </a>
</div>
<div class="create-btn-container">
    <div></div>
    <form action="{{route("post.index")}}" class="search-form">
        <input type="number" class="rol-select" min="1" name="id" placeholder="Search by user id" value="{{$request->id}}">
        <input maxlength="40" type="text" name="text" placeholder="Search by content" value="{{$request->text}}">
        <button type="submit"><i class="fas fa-2x fa-search"></i></button>
    </form>
</div>
<div class="table-container">
    <table>
        <tr>
            <th>To Post</th>
            <th>ID</th>
            <th>User</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
        @foreach ($posts as $post)
            <tr>
                <td><a href="{{route("thread", $post)}}"><i class="fas fa-2x fa-info-circle info-btn"></i></a></td>
                <td>{{$post->id}}</td>
                <td><a href="{{route("profile", $post->user)}}"><img class="img" src="{{asset($post->user->img)}}" alt=""></a></td>
                <td>
                    {{substr($post->created_at, 0,11)}}
                </td>
                <td>
                    <form action="{{route("post.destroy", $post)}}" method="POST">
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
    {{$posts->appends(Request::except("page"))->links()}}
</div>
@endsection
@section('js')
@endsection