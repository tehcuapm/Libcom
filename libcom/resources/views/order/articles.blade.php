@extends('layouts.base')
    <!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All articles for one order</title>
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
                <th>Title</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
            @if($articles !=null)
                @foreach($articles as $item)
                    @include("order.article-item",["item"=>$item,"quantity"=>$order->getArticleQuantity($item)])
                @endforeach
                {{--                <tr>--}}
                {{--                    <td></td>--}}
                {{--                    <td>=>{{$total_price}}</td>--}}
                {{--                    <td>=>{{$total_quantity}}</td>--}}
                {{--                   --}}

                {{--                </tr>--}}

            @endif


        </table>
    </div>
@endsection
</body>

</html>
