<tr>

    <td>
        <div class="product-infos">
            <a href="{{route("article.show",$item)}}"><img
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
        {{$item->price*$quantity}}
    </td>

</tr>
