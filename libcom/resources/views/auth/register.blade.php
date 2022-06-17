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

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-sect">
                        <p>Name :</p>
                        <input type="text" name="name" class="{{ $errors->has('name') ? 'invalid-input' : 'valid-input' }}"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="form-error-text">{{ $message }}</div>
                        @enderror
                    </div>
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
                        <p>Password :</p>
                        <input type="password" name="password"
                            class="{{ $errors->has('password') ? 'invalid-input' : 'valid-input' }}"
                            value="{{ old('password') }}">
                        @error('password')
                            <div class="form-error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-sect">
                        <p>Confirm password :</p>
                        <input type="password" name="password_confirmation"
                            class="{{ $errors->has('password_confirmation') ? 'invalid-input' : 'valid-input' }}"
                            value="{{ old('password_confirmation') }}">
                        @error('password_confirmation')
                            <div class="form-error-text">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-sect">

                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    @endsection


</body>

</html>
