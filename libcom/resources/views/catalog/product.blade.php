@extends('layouts.base')
    <!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>Product</title>
    <link rel="stylesheet" href="{{ asset('styles/produit.css') }}"/>
</head>

<body>

@section('content')
    <div id="content">
        <div id="product-details">
            <img src="{{ asset(ArticleHelper::handleImage($article))}}" alt="coussin-img" id="details-img">
            <div id="details-list">
                <h3 id="product-title">{{ $article->title }}</h3>
                <div class="hover-line"></div>
                <p id="product-cat">{{ $article->category->name }}</p>
                <p id="product-desc">
                    {{ $article->speech }}
                </p>
                <p id="product-price">${{ $article->price }}</p>
                <p id="product-stock" class="{{ $article->stock == 0 ? 'no-stock' : 'stock' }}">Stock:
                    {{ $article->stock }}
                </p>
                @if ($article->stock > 0)


                    <input type="text" name="quantity" id="product-quantity" value="1">
                    <button id="product-buy" product_id={{$article->id}}>ADD TO CART</button>

                @endif

            </div>
            @role('admin')
            @include('catalog.product-form',["article"=>$article])
            @endrole
        </div>
    </div>

@endsection
</body>
@push("scripts")
    <script src="/js/product.js"></script>
@endpush
</html>
