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
            <h2>Your order</h2>
            <form action="{{ route('order.store') }}" method="post">
                @csrf
                <div class="form-sect">
                    <p>Adresses for delivery :</p>
                    <select class="valid-input" name="address_id">

                        @foreach(Auth::user()->addresses()->get() as $address)
                            <option name="address_id"
                                    value="{{$address->id}}" {{old("address_id")==$address->id?"selected":""}}>{{$address->order_address}}</option>

                        @endforeach
                    </select>
                    @error('address_id')
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
