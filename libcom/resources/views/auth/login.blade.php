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
                <h2>Animalscom</h2>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-sect">
                        <p>Email :</p>
                        <input type="text" name="email"
                            class="{{ $errors->has('email') ? 'invalid-input' : 'valid-input' }}"
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="form-error-text">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-sect">
                        <p>Mot de passe :</p>
                        <input type="password" name="password"
                            class="{{ $errors->has('password') ? 'invalid-input' : 'valid-input' }}"
                            value="{{ old('password') }}">
                        @error('password')
                            <div class="form-error-text">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-sect" id="option">
                        <a href="{{ route('password.forgot') }}">Forgot Password ?</a>
                        <a href="{{ route('register.form') }}">I don't have account.</a>
                    </div>
                    <div class="form-sect">
                        <label>Se souvenir ?</label>
                        <input type="checkbox" name="remember[]">
                        <button type="submit">
                            Login
                        </button>
                        @if ($errors->first('login-failed'))
                            <div class="form-error-text">{{ $errors->first('login-failed') }}</div>
                        @endif
                    </div>

                </form>
            </div>
        </div>
    @endsection


</body>

</html>
