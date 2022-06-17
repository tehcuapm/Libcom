@extends('layouts.base')
    <!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All orders for this address</title>
    <link rel="stylesheet" href="{{asset('styles/panier.css')}}"/>
</head>

<body>
@section('content')
    @if(session()->has("message"))
        <div>{{session('message')}}</div>
    @endif
    <div id="content">
        <table class="table-style">
            <tr>
                <th>Address</th>
                <th>Creation date</th>
                <th>Order date</th>
                <th>See articles</th>

            </tr>
            @if($content !=null)
                @foreach($content as $order)
                    @include("order.order-item",["order"=>$order])
                @endforeach


            @endif


        </table>
    </div>
@endsection
</body>

</html>
