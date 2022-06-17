@extends('layouts.base')
    <!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Addresses</title>
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
                <th>Country</th>
                <th>Already Orders</th>
                <th>Delete</th>

            </tr>
            @if($content !=null)
                @foreach($content as $address)
                    @include("profile.address-item",["address"=>$address])
                @endforeach
                <tr>
                    <td>
                        <div class="all-buttons">
                            <div>
                                <a href="{{route("addresses.new",["user"=>$user])}}"><img class="icon"
                                                                                          src="{{asset("assets/add.png")}}"
                                                                                          alt="">
                                </a>
                            </div>

                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="all-buttons">
                            <div>
                                <a href="{{route("addresses.clear",["user"=>$user])}}"><img class="icon"
                                                                                            src="{{asset("assets/delete.png")}}"
                                                                                            alt="">
                                    <label>clear all</label>
                                </a>
                            </div>

                        </div>
                    </td>

                </tr>

            @endif


        </table>
    </div>
@endsection
</body>

</html>
