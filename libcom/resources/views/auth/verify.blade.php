@extends('layouts.base')
    <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('styles/authentification.css')}}">
    <title>Animalscom</title>
</head>

<body>
@section('content')
    <div id="content">
        <div class="form-container">
            <h2>Please verify your email for access to the entire content</h2>
            <form action="{{route('verification.send')}}" method="post">
                @csrf
                <div class="form-sect">

                    <button type="submit">Send email</button>
                </div>
            </form>
        </div>
    </div>
@endsection
</body>

</html>
