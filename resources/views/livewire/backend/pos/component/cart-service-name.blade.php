<tr>
    <td>
        <p>{{ $serviceName['name'] }}</p>
    <td>
        <div class="input-group" style="width: 150px;">
            <div class="input-group-prepend decrement" data-serviceNameId="{{$serviceNameId}}" style="cursor:pointer">
                <span class="input-group-text " >-</span>
            </div>
            <input type="number" wire:keyup="updateQty($event.target.value,'{{$serviceNameId}}')" name="qty[{{$serviceNameId}}][ ]"
                value="{{ $serviceName['qty'] }}"
                class="form-control text-center"
                >
            <div class="input-group-append increment"  data-serviceNameId="{{$serviceNameId}}"   style="cursor:pointer">
                <span class="input-group-text ">+</span>
            </div>
        </div>
    </td>
    <td>
        <input type="text" name="price[{{$serviceNameId}}][]" id="unit_price"
            value="{{ number_format($serviceName['service_price'], 2) }}"
            class="form-control">
    </td>
    <td >
        <input type="text" disabled class="form-control  text-center subtotal"
            id="subtotal" name="subtotal[{{$serviceNameId}}][]" value="{{ number_format($serviceName['subtotal'], 2) }}"
            class="form-control">
    </td>
    <td> <i class="fa fa-trash btn btn-danger" onclick="deleteServiceName($(this), {{$serviceNameId}})"
            style="cursor:pointer; font-size: 16px;" aria-hidden="true"></i>
    </td>
</tr>
