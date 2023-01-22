<tr>
    <td>1</td>

    <td>{{$item->name}} <input type="hidden" name="item_id[]" value="{{$item->id}}"></td>
    <td>
        <div class="input-group">

            <input type="number" class="form-control" id="purchase_qty" name="purchase_qty[]" value="1" placeholder="Enter Quantity">
            <div class="input-group-prepend">
                <select class="form-control" name="unit_id[]">
                    <option value="{{null}}">--</option>
                    @forelse ($units as $unit)
                        <option value="{{$unit->id}}" {{ $item->unit_id == $unit->id ? 'Selected':null }}>{{$unit->name}}</option>
                    @empty

                    @endforelse

                </select>
            </div>

        </div>

    </td>
{{-- @dd($item->tax_id ) --}}
    <td>
        <input type="number" class="form-control" id="up_before_tax" name="up_before_tax[]" value="{{ $item->up_before_tax}}">
    </td>
    <td>
        <input type="number" class="form-control" id="subtotal_up_before_tax" name="subtotal_up_before_tax[]" readonly value="{{ $item->up_before_tax}}">
    </td>
    <td>
        <div class="input-group">
            <div class="input-group-prepend">
                <select class="form-control" name="tax_id[]" id="tax_id" >
                    <option value="{{null}}">--</option>

                    @forelse ($taxs as $tax)
                    <option value="{{$tax->id}}" data-type ={{$tax->type}}
                        data-rate ={{$tax->rate}}
                        {{$tax->id  == $item->tax_id ? 'Selected':' ' }}>
                        {{$tax->name}}
                    </option>

                    @empty

                    @endforelse

                </select>
            </div>
            <input type="number" name="tax_rate[]" readonly id="tax_rate" value="{{$item->tax_rate??0}}" class="form-control" placeholder="tax rate"  >
        </div>
    </td>
    <td>
        <input type="number" class="form-control" readonly id="up_after_tax" name="up_after_tax[]" value="{{ $item->up_after_tax }}">
    </td>
    <td>
        <input type="number" class="form-control" readonly id="subtotal_up_after_tax" name="subtotal_up_after_tax[]" value="{{ $item->up_after_tax }}">
    </td>
    <td>
        <input type="number" class="form-control" id="profit_percent" name="profit_percent[]" value="{{ $item->profit_percent }}">

    </td>
    <td>
        <input type="text" class="form-control" id="un_sell_price"  name="un_sell_price[]" readonly  value="{{ number_format($item->sell_price , 2)}}">
    </td>
    <td><input type="text" class="form-control" id="total_sell_price" name="total_sell_price[]" readonly value="{{ number_format($item->sell_price , 2)}}"></td>
    <td>  <button type="button" class="btn btn-md" onclick="proDeleteRow($(this))" ><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></button> </td>
</tr>
