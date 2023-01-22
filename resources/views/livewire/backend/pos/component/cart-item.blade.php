<tr>
    <td>
        <p>{{ $item['name'] }}</p>
    <td>
        <div class="input-group" style="width: 150px;">
            <div class="input-group-prepend decrement" data-itemId="{{$itemId}}" style="cursor:pointer">
                <span class="input-group-text " >-</span>
            </div>
            <input type="number" wire:keyup="updateQty($event.target.value,'{{$itemId}}')" name="qty[{{$itemId}}][ ]"
                value="{{ $item['qty'] }}"
                class="form-control text-center"
                >
            <div class="input-group-append increment"  data-itemId="{{$itemId}}"   style="cursor:pointer">
                <span class="input-group-text ">+</span>
            </div>
        </div>
    </td>
    <td>
        <input type="text" name="price[{{$itemId}}][]" id="unit_price"
            value="{{ number_format($item['sell_price'], 2) }}"
            class="form-control">
    </td>
    <td >
        <input type="text" disabled class="form-control  text-center subtotal"
            id="subtotal" name="subtotal[{{$itemId}}][]" value="{{ number_format($item['subtotal'], 2) }}"
            class="form-control">
    </td>
    <td> <i class="fa fa-trash btn btn-danger" onclick="deleteItem($(this), {{$itemId}})"
            style="cursor:pointer; font-size: 16px;" aria-hidden="true"></i>
    </td>
</tr>
