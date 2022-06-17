@extends("layouts.base")
    <!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
@section('content')
    <div id="content">
        <div class="form-container">
            <h2>Your addresses</h2>
            <form action="{{ route('order.store') }}" method="post">
                @csrf
                <div class="form-sect">
                    <p>Pays(europe) :</p>
                    <select autocomplete="off" id="country" name="country"
                            class="{{ $errors->has('country') ? 'invalid-input' : 'valid-input' }}">

                        <option>--Select country--</option>
                        @foreach ($countries as $country)

                            <option {{ old('country') == $countLoginry->name ? 'selected' : '' }}>{{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('country')
                    <div class="form-error-text">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-sect">
                    <p>Adresses for delivery :</p>
                    <input type="text" name="order_address"
                           class="{{ $errors->has('order_address') ? 'invalid-input' : 'valid-input' }}"
                           value="{{ old('order_address') }}">
                    @error('order_address')
                    <div class="form-error-text">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-sect">
                    <p>Date for delivery</p>
                    <input type="date" name="order_date"
                           class="{{ $errors->has('order_date') ? 'invalid-input' : 'valid-input' }}"
                           value="{{ old('order_date') }}">
                    @error('order_date')
                    <div class="form-error-text">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-sect">
                    <button type="submit">
                        Order !!
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
</body>

</html>
