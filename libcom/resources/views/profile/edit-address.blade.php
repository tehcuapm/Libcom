@extends('layouts.base')
    <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('styles/authentification.css') }}">
    <title>Animalscom</title>
    @push("head")
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBh1rBk3cvz6Txersz3l4qredC8dCey66w&libraries=places">
        </script>
    @endpush
</head>

<body>
@section('content')
    <div id="content">
        <div class="form-container">
            <h2>Edit address</h2>
            <form action="{{ route('address.edit',["address"=>$address]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-sect">
                    <p>Name of address :</p>
                    <input type="text" name="order_address" id="autocomplete"
                           class="{{ $errors->has('order_address') ? 'invalid-input' : 'valid-input' }}"
                           value="{{ old('order_address')!=""?old('order_address'):$address->order_address }}">
                    @error('order_address')
                    <div class="form-error-text">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-sect">
                    <p>Country :</p>

                    <select autocomplete="off" id="country" name="country"
                            class="{{ $errors->has('country') ? 'invalid-input' : 'valid-input' }}">

                        <option>--Select country--</option>
                        @foreach ($countries as $country)

                            <option {{ $address->country == $country->name ? 'selected' : '' }}>{{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('country')
                    <div class="form-error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-sect">

                    <button type="submit">
                        Update
                    </button>

                </div>

            </form>
        </div>
    </div>
@endsection


</body>
@push("scripts")
    <script src="{!! mix('js/place-autocomplete.js') !!}"></script>
@endpush
</html>
