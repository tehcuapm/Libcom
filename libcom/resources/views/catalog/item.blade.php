<div class="product-item">
    <img src="{{ asset(ArticleHelper::handleImage($product)) }}" class="item-img">
    <h4 class="item-title">{{ $product->title }}</h4>
    <div class="items-buttons">
        <form method="GET" action="{{ route('article.show', ['id' => $product->id]) }}">
            @csrf
            <button type="submit">SEE</button>
        </form>
        @if ($product->stock > 0)
                <button class="add-product-button" product_id={{$product->id}}>BUY</button>
        @endif

    </div>
</div>
