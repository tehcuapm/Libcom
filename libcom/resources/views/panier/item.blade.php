<tr>

    <td>
        <div class="product-infos">
            <a><img
                    src={{asset(ArticleHelper::handleImage($item))}} alt="coussin"
                    class="product-photo"></a>
            <label>{{$item->title}}({{$item->stock}})</label>
        </div>

    </td>
    <td>{{$item->price}}</td>
    <td>
        <p>{{$quantity}}</p>
    </td>
    <td>
        <div class="all-buttons">
            <a href="{{route("panier.remove",["article"=>$item])}}"><img
                    src="{{asset("assets/delete.png")}}"
                    alt="" class="icon"></a>

            <input type="text" name="quantity" class="quantity" value="{{$quantity}}" id="panier-quantity">
            <button id="panier-update"><img class="icon" src="/assets/update.png"></button>


        </div>

    </td>
</tr>
