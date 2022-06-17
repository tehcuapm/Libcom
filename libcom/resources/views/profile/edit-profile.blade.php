@extends('layouts.base')
    <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('styles/authentification.css')}}">
    <title>Profile Edition</title>
</head>

<body>
@section('content')

    <div id="content">
        <div class="form-container">
            <h2>Edit profile</h2>

            <form method="POST" action="{{route("profile.edit",["user"=>$user])}}">
                @csrf
                <div class="form-sect">
                    <p>Nom :</p>
                    <input type="text" name="name" class="{{$errors->has('name') ? 'invalid-input' : 'valid-input'}}"
                           value="{{old('name')!=""?old('name'):$user->name}}">
                    @error('name')
                    <div class="form-error-text">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-sect">
                    <p>Email :</p>
                    <input type="email" name="email" class="{{$errors->has('email') ? 'invalid-input' : 'valid-input'}}"
                           value="{{old('email')!=""?old('email'):$user->email}}">
                    @error('email')
                    <div class="form-error-text">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-sect">
                    <p>Avatar :</p>

                    <select name="current_avatar" autocomplete="off" class="valid-input">
                        @foreach ($avatars as $avatar)
                            <option
                                value={{$avatar->id }} {{ $user->current_avatar == $avatar->id ? 'selected' : '' }}>
                                {{$avatar->name}}
                            </option>
                        @endforeach
                    </select>

                </div>
                <div class="form-sect">
                    <p>Public ?</p>
                    <input class="valid-input" name="public_profile"
                           type="checkbox" {{$user->public_profile==1?"checked":""}}>
                </div>

                <div class="form-sect">

                    <button type="submit">Confirmez</button>
                </div>
            </form>
        </div>
        <div class="form-container">
            <form method="POST" enctype="multipart/form-data" action="{{route("avatar.add",["user"=>$user])}}">
                @csrf
                <div class="form-sect">
                    <p>Ajouter un avatar:</p>
                    <input type="file" name="avatar_img" id="" class="valid-input">
                    <input type="submit" class="valid-input">
                    @error("avatar_img")
                    <p class="form-error-text">{{$message}}</p>
                    @enderror
                </div>

            </form>
        </div>
    </div>

@endsection


</body>

</html>
