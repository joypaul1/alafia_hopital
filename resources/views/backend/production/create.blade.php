@extends('backend.layout.app')


@section('page-header')
<i class="fa fa-list"></i> Production Create
@stop
@section('content')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <style>
        .ui-autocomplete {
            position: absolute;
            cursor: default;
            z-index: 99999999999999 !important
        }

        .product-grid-container {
            display: grid;
            grid-template-columns: 1fr;
        }

        @media (min-width: 768px) {
            .product-grid-container {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 15px;
            }
        }
    </style>
@endpush

@include('backend._partials.modal_page_header', [
'fa' => 'fa fa-plus-circle',
'name' => 'Production list',
'route' => route('backend.production.create')
])

<div class="row">
    <div class="col-12">
        <form action="{{ route('backend.production.store') }}" method="post">
            @csrf
            @method("POST")
            <div class="card">
                <div class="body">
                    {{-- <h3 class="mb-3 text-center">Restaurant</h3>
                    <hr> --}}

                    <div class="row">
                        {{-- <div class="col-md-2">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'sl_no', 'value'=> '1', 'required'=> true ])
                            @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('sl_no')])
                        </div> --}}
                        <div class="col-md-3">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder'=> 'Enter Name Here ... ', 'required'=> true ])
                            @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('name')])
                        </div>
                        <div class="col-md-3">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'date', 'placeholder'=> 'Enter Name Here ... ', 'required'=> true, 'type' => 'date' ])
                            @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('name')])
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label">
                                Description
                                <span class="text-danger">* </span>
                            </label>
                            <textarea name="description" class="form-control" placeholder="Enter Description Here ..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="body justify-content-center">
                    <h3 class="mb-3 text-center">Production Items</h3>
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search-plus"
                                        aria-hidden="true"></i></span>
                            </div>
                            @include('components.backend.forms.input.input-type2', [
                                'name' => 'product_name',
                                'placeholder' => 'Enter Product Name / SKU',
                                // 'value' =>$itemDetails,
                                'required' => true,
                            ])

                            <div class="input-group-prepend">
                                <span class="input-group-text" data-toggle="modal" data-target="#product-add-modal">
                                    <i class="fa fa-plus" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="res-table" ellspacing='0' class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th> Item Id.</th>
                                    <th> Unit</th>
                                    <th> Quantity</th>
                                    <th> Price</th>
                                    <th> Total</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="productionItem"></tr>

                            </tbody>
                        </table>
                        <div class=" form-inline d-flex justify-content-end">
                            <div class="form-group">
                                <label for="email">Approximate Sell:</label>
                                <input type="text" readonly name="approximateSell"  class="form-control" id="approximateSell">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="body">
                    <h3 class="mb-3 text-center">Production Item Materials</h3>
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search-plus"
                                        aria-hidden="true"></i></span>
                            </div>
                            @include('components.backend.forms.input.input-type2', [
                                'name' => 'material_name',
                                'placeholder' => 'Enter Product Name / SKU',
                                // 'value' =>$itemDetails,
                                'required' => true,
                            ])

                            <div class="input-group-prepend">
                                <span class="input-group-text" data-toggle="modal" data-target="#product-add-modal">
                                    <i class="fa fa-plus" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="res-table" ellspacing='0' class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th> Item Id.</th>
                                    <th> Unit</th>
                                    <th> Quantity</th>
                                    <th> Price</th>
                                    <th> Total</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="materialsItem"></tr>

                            </tbody>
                        </table>
                        <div class=" form-inline d-flex justify-content-end">
                            <div class="form-group">
                                <label for="email">Approximate Cost:</label>
                                <input type="text" readonly name="approximateCost"  class="form-control" id="approximateCost">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card text-center">
                <div class="body">
                    <strong >ApproximateProfit : <span id="approximateProfit">0.00</span>Tk </strong>
                </div>
            </div>
            <div class="d-block text-center">

                <button class="btn btn-md btn-success ">Save</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade add_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">

    </div>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
        $("#product_name").autocomplete({
            source: function(request, response) {
                var optionData = request.term;
                $.ajax({
                    method: 'GET',
                    url: "{{ route('backend.itemconfig.item.index') }}",
                    data: {
                        'optionData': optionData
                    },
                    success: function(res) {
                        var resArray = $.map(res.data, function(obj) {
                            console.log(obj.sell_price);
                            return {
                                sell_price: obj.sell_price, //Fillable in input field
                                unit: obj.unit, //Fillable in input field
                                value: obj.name, //Fillable in input field
                                value_id: obj.id, //Fillable in input field
                                label: 'Name:' + obj.name + ' sku:' + obj.sku, //Show as label of input fieldname: obj.name, sku: obj.sku
                            }
                        })
                        response(resArray);
                    }
                });
            },
            minLength: 3,
            select: function(event, ui) {
                let html = '<tr>'
                    html += '<td> <input type="text" readonly  class="form-control text-center" value="'+ui.item.value+'"></td>'
                    html += ' <input type="hidden"  name="pItem_id[]" class="form-control text-cente" value="'+ui.item.value_id+'">'
                    html+= '<td> <input type="text" readonly  name="unit[]" class="form-control text-center" value="'+ui.item.unit.name+'"></td>'
                    html+= '<td> <input type="text"   name="p_qty[]" class="form-control text-center p_qty" value="'+1+'"></td>'
                    html+= '<td> <input type="text" readonly  name="pu_price[]" class="form-control text-center pu_price" value="'+parseFloat(ui.item.sell_price).toFixed(2)+'"></td>'
                    html+= '<td> <input type="text" readonly  name="p_total_price[]" class="form-control text-center p_total_price" value="'+parseFloat(ui.item.sell_price).toFixed(2)+'"></td>'
                    html+= '<td> <button class="btn btn-danger" onclick="removeRow(this)">-</button></td>'
                    html += '</tr>'
                $('#productionItem').after(html);
                approximateSellPrice();
                approximateProfit();
            }
        });

        $("#material_name").autocomplete({
            source: function(request, response) {
                var optionData = request.term;
                $.ajax({
                    method: 'GET',
                    url: "{{ route('backend.itemconfig.item.index') }}",
                    data: {
                        'optionData': optionData
                    },
                    success: function(res) {
                        var resArray = $.map(res.data, function(obj) {
                            return {
                                sell_price: obj.sell_price, //Fillable in input field
                                unit: obj.unit, //Fillable in input field
                                value: obj.name, //Fillable in input field
                                value_id: obj.id, //Fillable in input field
                                label: 'Name:' + obj.name + ' sku:' + obj.sku, //Show as label of input fieldname: obj.name, sku: obj.sku
                            }
                        })
                        response(resArray);
                    }
                });
            },
            minLength: 3,
            select: function(event, ui) {
                let html = '<tr>'
                    html += '<td> <input type="text" readonly  class="form-control text-center" value="'+ui.item.value+'"></td>'
                    html += ' <input type="hidden"  name="mItem_id[]" class="form-control text-cente" value="'+ui.item.value_id+'">'
                    html+= '<td> <input type="text" readonly  name="unit[]" class="form-control text-center" value="'+ui.item.unit.name+'"></td>'
                    html+= '<td> <input type="text"   name="m_qty[]" class="form-control text-center m_qty" value="'+1+'"></td>'
                    html+= '<td> <input type="text" readonly  name="mu_price[]" class="form-control text-center mu_price" value="'+parseFloat(ui.item.sell_price).toFixed(2)+'"></td>'
                    html+= '<td> <input type="text" readonly  name="m_total_price[]" class="form-control text-center m_total_price" value="'+parseFloat(ui.item.sell_price).toFixed(2)+'"></td>'
                    html+= '<td> <button class="btn btn-danger" onclick="removeMRow(this)">-</button></td>'
                    html += '</tr>'
                $('#materialsItem').after(html);
                approximateCost();
                approximateProfit();
            }
        });


    // create a function to remove a row
    function removeRow(row) {
        $(row).closest('tr').remove();
        approximateSellPrice();
    }
    function removeMRow(row) {
        $(row).closest('tr').remove();
        approximateCost();
    }

    $(document).on('keyup', '.p_qty', function() {
        var p_qty = $(this).val();
        var pu_price = $(this).closest('tr').find('.pu_price').val();
        pu_price = Number(pu_price.replace(/[^0-9\.]+/g,""));
        var p_total_price = p_qty * pu_price;
        $(this).closest('tr').find('.p_total_price').val(p_total_price);
        approximateSellPrice();
        approximateProfit();
    });
    $(document).on('keyup', '.m_qty', function() {
        var m_qty = $(this).val();
        var mu_price = $(this).closest('tr').find('.mu_price').val();
        mu_price = Number(mu_price.replace(/[^0-9\.]+/g,""));
        var p_total_price = m_qty * mu_price;
        $(this).closest('tr').find('.m_total_price').val(p_total_price);
        approximateSellPrice();
        approximateProfit();
    });


    approximateSellPrice = function() {
        var total = 0;
        $('.p_total_price').each(function() {
            total += Number($(this).val().replace(/[^0-9\.]+/g,""));
        });
        $('#approximateSell').val(total.toFixed(2));

        return total;
    }
    approximateCost = function() {
        var total = 0;
        $('.m_total_price').each(function() {
            total += Number($(this).val().replace(/[^0-9\.]+/g,""));
        });
        $('#approximateCost').val(total.toFixed(2));
        return total;
    }
    function approximateProfit  (){
        $('#approximateProfit').text(approximateSellPrice()-approximateCost());
        console.log( approximateSellPrice()-approximateCost(),'profile');
    }

</script>

@endpush
