<tr>
    <td>{{$order->address->order_address}}</td>
    <td>{{$order->created_at}}</td>
    <td>{{$order->order_date}}</td>

    <td>
        <div class="all-buttons">
            <a href="{{route("order.show",["order"=>$order])}}"><img
                    src="{{asset("assets/product.png")}}"
                    alt="" class="icon"></a>

        </div>

    </td>
</tr>
