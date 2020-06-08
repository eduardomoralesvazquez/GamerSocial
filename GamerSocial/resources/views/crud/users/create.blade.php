@extends('templates.logged')
@section("links")
<link rel="stylesheet" href="{{asset("css/app/config.css")}}">
@endsection
@section('content')
    <div class="container">
        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{$item}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="config-form" method="POST" action="{{route("user.store")}}">
            @csrf
            <div>
                <input maxlength="40" type="text" name="name" placeholder="User Name" required>
            </div>
            <div>
                <input maxlength="40" type="text" name="real_name" placeholder="Real Name" required>
            </div>
            <div>
                <input maxlength="80" type="text" name="last_name" placeholder="Last Name" required>
            </div>
            <div>
                <input maxlength="80" type="email" name="email" placeholder="Email" required>
            </div>
            <div>
                <input maxlength="40" type="password" name="password" placeholder="Password" required>
            </div>
            <div>
                <textarea maxlength="1000" name="description" id="description" cols="30" rows="5" placeholder="description" required></textarea>
            </div>
            <div>
                Roles
                <select name="role_id" id="role_id"  required>
                    @foreach ($roles as $rol)
                        @if ($rol->name != "administrator")
                            <option value="{{$rol->id}}">{{$rol->name}}</option>                            
                        @endif
                    @endforeach
                </select>
            </div>
            <button class="btn" type="submit">Submit</button>
        </form>
    </div>
@endsection
@section('js')
@endsection