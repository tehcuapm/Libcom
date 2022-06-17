<tr>
    <td>{{$address->order_address}}</td>
    <td>
        <p>{{$address->country}}</p>
    </td>
    <td>

        <a href="{{route("address.orders",["address"=>$address])}}"><p>{{$address->getAlreadyOrderCount()}}</p></a>
    </td>
    <td>
        <div class="all-buttons">
            <a href="{{route("address.delete",["address"=>$address])}}"><img
                    src="{{asset("assets/delete.png")}}"
                    alt="" class="icon"></a>
            <a href="{{route("address.form",["address"=>$address])}}"><img
                    src="{{asset("assets/edit.png")}}"
                    alt="" class="icon"></a>
        </div>

    </td>
</tr>
