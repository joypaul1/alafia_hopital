<tr>
    <td>
        <p>{{$item->name}}</p>
        <input type="hidden" class="item_ids" name="item_ids[]" value="{{$item->id}}">
    </td>
    <td>
        <div class="input-group" style="width: 150px;">
            <div class="input-group-prepend">
                <a href="#"><span class="input-group-text minus">-</span></a>

            </div>
            <input type="number" name="qty[]" value="1" class="form-control text-center">
            <div class="input-group-append">
                <a href="#"><span class="input-group-text add">+</span></a>
            </div>
        </div>
    </td>
    <td><input type="text" name="price[]" id="unit_price" value="{{ number_format($item->sell_price , 2)}}"
            class="form-control"></td>
    <td><input type="text" disabled class="form-control  text-center subtotal" id="subtotal"
            value="{{ number_format($item->sell_price , 2)}}" class="form-control"></td>
    <td> <i class="fa fa-trash btn btn-danger" onclick="deleteItem($(this))" style="cursor:pointer; font-size: 16px;"
            aria-hidden="true"></i></td>
</tr>
