@extends('layouts.base')
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styles/catalogue.css') }}" />

    <title>Catalog</title>
</head>


<body>
    @section('content')
        <div id="search-div">
            <input type="text" id="search-bar" placeholder="Search Bar">
        </div>

        <div id="products-list">
            @foreach ($products as $product)
                @include("catalog.item",['item'=>$product])
            @endforeach
        </div>
    @endsection
</body>
@push('scripts')
    <script src="js/catalog.js"></script>
@endpush

</html>
