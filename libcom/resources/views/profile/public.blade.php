@extends('layouts.base')
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{$user->name}}</title>
    <link rel="stylesheet" href="{{asset("styles/profile.css")}}">
    <link rel="stylesheet" href="{{asset("styles/authentification.css")}}">
</head>

<body>
@section('content')
    <div id="content">
        <div id="profile-container">
            <img src="{{asset(UserHelper::handleAvatar($user))}}" id="profile-picture">
            <div id="profile-infos">
                <h1 id="profile-name">{{$user->name}}</h1>
                @if(Config::get("constants.options.verify"))
                    <p>{{!UserHelper::checkVerified($user) ?"No ":""}}Verified</p>

                @endif
                @if($user->hasRole("admin"))
                    <p>Admin</p>
                @endif
                <p>{{$user->email}}</p>
                <div class="form-container">

                    @if(UserHelper::checkProfile($user))
                        <form method="GET" action="{{route("profile.editor",["user"=>$user])}}">
                            @csrf
                            <div class="form-sect">
                                <button>Edit Profile</button>
                            </div>
                        </form>
                        <form method="GET" action="{{route("addresses.index",["user"=>$user])}}">
                            @csrf
                            <div class="form-sect">
                                <button>Edit addresses</button>
                            </div>
                        </form>
                    @else
                        <form method="POST">
                            @csrf
                            <div class="form-sect">
                                <button>Send Message</button>
                            </div>
                        </form>
                    @endif

                </div>
            </div>

        </div>

    </div>
@endsection
</body>

</html>
