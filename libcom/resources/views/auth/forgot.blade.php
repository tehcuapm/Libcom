@extends('layouts.base')
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('styles/authentification.css') }}">
    <title>Animalscom</title>
</head>

<body>
    @section('content')
        <div id="content">
            <div class="form-container">
                <h2>Forgot Password ? </h2>
                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="form-sect">
                        <p>Email :</p>
                        <input type="email" name="email"
                            class="{{ $errors->has('email') ? 'invalid-input' : 'valid-input' }}"
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="form-error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-sect">

                        <button type="submit">Confirmez</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
</body>

</html>
