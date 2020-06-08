@extends('templates.logged')
@section("links")
    <link rel="stylesheet" href="{{asset("css/app/crud.css")}}">
@endsection
@section('content')
    <div class="crud-nav-container">
        <a href="{{route("user.index")}}" class="actived">
            <div>Users</div>
        </a>
        <a href="{{route("project.index")}}">
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
        <a href="{{route("user.create")}}"><i class="fas fa-2x fa-plus-circle create-btn"></i></a>
        <form action="{{route("user.index")}}" class="search-form">
            <select name="role" class="rol-select">
                <option value="0">Search by rol</option>
                @foreach ($roles as $role)
                    @if ($role->id == $request->role)
                        <option value="{{$role->id}}" selected>{{str_replace("_", " ", ucfirst($role->name))}}</option>
                    @elseif($role->name == "administrator")

                    @else
                        <option value="{{$role->id}}">{{str_replace("_", " ", ucfirst($role->name))}}</option>                
                    @endif
                @endforeach
            </select>
            <input maxlength="40" type="text" name="search" placeholder="Search by name" value="{{$request->search}}">
            <button type="submit"><i class="fas fa-2x fa-search"></i></button>
        </form>
    </div>
    <div class="table-container">
        <table>
            <tr>
                <th>Profile</th>
                <th>ID</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Verified</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td><a href="{{route("profile", $user)}}"><i class="fas fa-2x fa-info-circle info-btn"></i></a></td>
                    <td>{{$user->id}}</td>
                    <td><img class="img" src="{{asset($user->img)}}" alt=""></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if ($user->email_verified_at != null)
                            Yes
                        @else
                            No
                        @endif
                    </td>
                    <td>
                        {{substr($user->created_at, 0,11)}}
                    </td>
                    <td>
                        <form action="{{route("user.destroy", $user)}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <a href="{{route("user.edit", $user)}}"><i class="far fa-2x fa-edit edit"></i></a>
                            <button type="submit" class="delete"><i class="fas fa-2x fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="paginate-controller">     
        {{$users->appends(Request::except("page"))->links()}}
    </div>
@endsection
@section('js')
@endsection