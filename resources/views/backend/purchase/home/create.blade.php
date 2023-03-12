@extends('backend.layout.app')
@push('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@section('page-header')
<i class="fa fa-plus-circle"></i> Purchase Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Add Purchase',
'route' => route('backend.purchase.index')
])

<div class="row">
    <div class="col-lg-12">
        <form class="needs-validation" action="{{ route('backend.purchase.store') }}" method="Post" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="card border-top">
                <div class="card-body">
                    <div class="form-validation">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="col-form-label">
                                    Supplier: <span class="text-danger">*</span>
                                </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    @include('components.backend.forms.select2.option2',[ 'label' =>'supplier' ,'name' =>'supplier_id','optionDatas' => [] , 'required'=> true])
                                    @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('supplier_id')])
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="background-color:#17a2b8;color:white"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label">
                                    Purchase Date: <span class="text-danger">*</span>
                                </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control" name="purchase_date" placeholder="date" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">
                                    Receive Date:
                                </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control" name="receive_date" placeholder="date">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'purchase_status','optionDatas'=> $pur_status , 'required' => true])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('purchase_status')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'label' => 'Warehouse location','name' => 'warehouse_id','optionDatas'=> [], 'required' => true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('warehouse_id')])
                                </div>
                            </div>

                            <div class="col-md-4">

                                @include('components.backend.forms.input.input-image3', ['name' => 'attach_document'])
                                <small>Allowed File: .pdf, .csv, .zip, .doc, .docx, .jpeg, .jpg, .png </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-top">
                <div class="card-body ">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <label class="col-form-label">
                                Search Product:
                            </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="search_product" placeholder="Enter Product Name / SKU">
                            </div>
                        </div>

                        <div class="col-md-2">
                            {{-- <button class="btn btn-info">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                Add New Product
                            </button> --}}
                        </div>
                    </div>
                    <hr>
                    <table class="table table-bordered product-table">
                        <thead style="background: #3380ff;color: white;text-align: center;">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Purchase Quantity</th>
                                <th scope="col">Unit Cost (Before Tax)</th>
                                <th scope="col">Subtotal (Before Tax)</th>
                                <th scope="col">Product Tax</th>
                                <th scope="col">Unit Cost (Inc. Tax)</th>
                                <th scope="col">Subtotal (Inc. tax)</th>
                                <th scope="col">Profit Margin %</th>
                                <th scope="col">Unit Selling Price (Inc. tax)</th>
                                <th scope="col">Total Selling Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr></tr>

                        </tbody>
                        <tfoot>
                            <tr class="text-right">
                                <td colspan="10">
                                    <strong >SubTotal : </strong>
                                </td>
                                <td >
                                    <strong id="pur_sub_total">0.00 </strong>
                                    <input type="hidden" name="pur_sub_total" id="" value="0">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card border-top">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                @include('components.backend.forms.select2.option',[ 'name' => 'discount_type', 'optionDatas'=> $dis_status ])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('discount_type')])
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'discount_amount','number' => true, 'placeholder' => 'Enter Discount Amount'])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('discount_amount')])
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Discount:(-)  <strong id="pur_dis_amount"> 0.00</strong> </h6>
                            <input type="hidden" name="pur_dis_amount" value="0.00">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label" for="pur_tax_id">
                                    Purchase Tax :
                                </label>
                                <select class="form-control" name="pur_tax_id" id="pur_tax_id" >
                                    <option value="{{null}}">-select tax-</option>

                                    @forelse ($taxs as $tax)
                                        <option value="{{$tax->id}}" data-type ={{$tax->type}} data-rate ={{$tax->rate}}>
                                            {{$tax->name}}
                                        </option>
                                    @empty
                                    @endforelse

                                </select>
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('purchase_tax')])
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">
                            <h6>Purchase Tax Amount: (+) <strong id="pur_tax_amount"> 0.00</strong> </h6>
                            <input type="hidden" name="pur_tax_amount" value="0.00">

                        </div>
                    </div>
                    <hr>
                    <div>
                        <label class="col-form-label">
                            Additional Notes
                        </label>
                        <textarea class="form-control" name="additional_notes" rows="5"></textarea>
                    </div>
                </div>
            </div>

            <div class="card border-top">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',[ 'name' =>'shipping_details','placeholder' => 'Enter Shipping Details here...'])
                                @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('shipping_details')])
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',[ 'name' =>
                                'additional_shipping_charge', 'number'=> true ,'placeholder' => 'Enter Shipping Charges here...'])
                                @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('additional_shipping_charge')])
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6  style="text-align: right;">
                        Purchase Total: <strong id="pur_total" >0.00</strong>
                        <input type="hidden" name="pur_total"  value="0.00">
                    </h6>
                </div>
            </div>
            <div class="card border-top">
                <div class="card-body">
                    <h5>
                        Add Payment
                    </h5>
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',['label'=> 'Payment Amount' ,'name' => 'payment_amount','placeholder' => 'Enter amount here...', ])
                                @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('payment_amount')])
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label">
                                Paid On:
                            </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="date" name="paid_date" class="form-control" placeholder="Paid date">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label">
                                Payment Method:
                            </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                    </span>
                                </div>
                                @include('components.backend.forms.select2.option2',['label'=> 'Payment Method','name' =>'payment_method','optionDatas' => $payment_methods])
                                @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('payment_method')])
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label">
                                Payment Account:
                            </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                    </span>
                                </div>
                                @include('components.backend.forms.select2.option2',['label' =>'Payment Account' ,'name' =>'payment_account','optionDatas' => $payment_accounts])
                                @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('payment_account')])
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',['label'=> 'Due Amount', 'value'=>0, 'name' => 'due_amount','value'=>0 ,'readonly'=>true ,'placeholder' => 'due amount here...', ])
                                @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('due_amount')])
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="col-form-label">
                                Payment note:
                            </label>
                            <textarea name="payment_note" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                    </div>

                    {{-- <hr>
                    <h6 style="text-align: right;">
                        Payment due: $ 0.00
                    </h6> --}}
                </div>
            </div>
            <div class="form-group">
                @include('components.backend.forms.input.submit-button')
            </div>
        </form>
    </div>
</div>


@endsection


@push('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    let taxRate  = purdisRate = 0;
    let totaltaxRate   = 0;
    let purchasesubAmount = $("#pur_sub_total");
    let purchaseAmount = $("#pur_total");
    const funRow = {
        purchase_qty: (currentRow) => {
            return currentRow.find("td input[id='purchase_qty']");
        },
        up_before_tax: (currentRow) => {
            return currentRow.find("td input[id='up_before_tax']");
        },
        subtotal_up_before_tax: (currentRow) => {
            return currentRow.find("td input[id='subtotal_up_before_tax']");
        },
        tax_id: (currentRow) => {
            return currentRow.find("td select[id='tax_id']");
        },
        tax_rate: (currentRow) => {
            return currentRow.find("td input[id='tax_rate']");
        },
        up_after_tax: (currentRow) => {
            return currentRow.find("td input[id='up_after_tax']");
        },
        subtotal_up_after_tax: (currentRow) => {
            return currentRow.find("td input[id='subtotal_up_after_tax']");
        },
        profit_percent: (currentRow) => {
            return currentRow.find("td input[id='profit_percent']");
        },
        un_sell_price: (currentRow) => {
            return currentRow.find("td input[id='un_sell_price']");
        },
        total_sell_price: (currentRow) => {
            return currentRow.find("td input[id='total_sell_price']");
        },
    };

    $(document).on('input',
    "table.product-table>tbody>tr>td input[id='purchase_qty'],table.product-table>tbody>tr>td input[id='up_before_tax'],table.product-table>tbody>tr>td input[id='profit_percent'],table.product-table>tbody>tr>td select[id='tax_id']",
    function(e){
        calculationOnInput($(this))
        calc_total();
        discount_type();
        pur_tax_id();
    });

    $(document).on('change', '#pur_tax_id', function(e){
        pur_tax_id();
    });
    $(document).on('change', '#discount_type, #discount_amount', function(e){
        discount_type();
    });
    function discount_type(){
        let $dis_data_type          =   $('#discount_type').find(':selected').val()||null;
        let $dis_data_rate          =   $('#discount_amount').val()||0;
        if($dis_data_type == 'percent'){
            purdisRate =  Number((Number(purchasesubAmount.text())* Number($dis_data_rate))/100);
        }else if($dis_data_type == 'flat') {
            purdisRate =  Number($dis_data_rate);
        }else{
            purdisRate = 0;
            $('#discount_amount').val(0);
        }
        let amount  =  Number(purdisRate);
        $("#pur_dis_amount").text(amount.toFixed(2));
        $("input[name='pur_dis_amount']").val(amount.toFixed(2));
        let pur_tax_amount = $("input[name='pur_tax_amount']").val();
        let pur_sub_total  = Number(purchasesubAmount.text())- Number(purdisRate) + Number(pur_tax_amount) ;
        purchaseAmount.text(pur_sub_total.toFixed(2));
        $("input[name='pur_total']").val(pur_sub_total.toFixed(2));
    }
    function pur_tax_id() {
        let purtaxRate =0;
        let $tax_data_type          =   $('#pur_tax_id').find(':selected').data('type')||null;
        let $tax_data_rate          =   $('#pur_tax_id').find(':selected').data('rate')||0;
        if($tax_data_type == 'percent'){
            purtaxRate =  Number((Number(purchasesubAmount.text())* Number($tax_data_rate))/100);
        }else if($tax_data_type == 'flat') {
            purtaxRate =  Number($tax_data_rate);
        }
        $("#pur_tax_amount").text(purtaxRate.toFixed(2));
        $("input[name='pur_tax_amount']").val(purtaxRate.toFixed(2));
        let pur_dis_amount =$("input[name='pur_dis_amount']").val()||0;
        let totalAmount = Number(Number(purchasesubAmount.text()) + Number(purtaxRate) - Number(pur_dis_amount));
        purchaseAmount.text(totalAmount.toFixed(2));
    }
    $(document).on('input',"#additional_shipping_charge", function(e){
        let inputVal =  $(this).val();
        let amount   = Number(Number(purchaseAmount.text()) + Number(inputVal));
        purchaseAmount.text(amount.toFixed(2));
        $("input[name='pur_total']").val(amount.toFixed(2));
    });
    $(document).on('input',"#payment_amount", function(e){
        let inputVal =  $(this).val();
        if($.isNumeric(inputVal) == false){
            $(this).val(0);
        }
        let amount   = Number(Number(purchaseAmount.text()) - Number(inputVal));
        $("input[name='due_amount']").val(amount.toFixed(2));

    });

    function calculationOnInput(here) {
        let $currentRow             =   here.closest('tr');
        let $purchase_qty           =   funRow.purchase_qty($currentRow).val()||1;
        let $up_before_tax          =   funRow.up_before_tax($currentRow);
        let $subtotal_up_before_tax =   funRow.subtotal_up_before_tax($currentRow);
        let $tax_id                 =   funRow.tax_id($currentRow);
        let $tax_data_type          =   $tax_id.find(':selected').data('type')||null;
        let $tax_data_rate          =   $tax_id.find(':selected').data('rate')||0;
        let $tax_rate               =   funRow.tax_rate($currentRow);
        let $up_after_tax           =   funRow.up_after_tax($currentRow);
        let $subtotal_up_after_tax  =   funRow.subtotal_up_after_tax($currentRow);
        let $profit_percent         =   funRow.profit_percent($currentRow);
        let $un_sell_price          =   funRow.un_sell_price($currentRow);
        let $total_sell_price       =   funRow.total_sell_price($currentRow);

        $subtotal_up_before_tax.val(Number(($purchase_qty * $up_before_tax.val()).toFixed(2)));

        if($tax_data_type == 'percent'){
            taxRate =  Number((Number($up_before_tax.val())* Number($tax_data_rate))/100);
        }else if($tax_data_type == 'flat') {
            taxRate =  Number($tax_data_rate);
        }
        taxRate  = Number(taxRate.toFixed(2));
        totaltaxRate = Number((taxRate*$purchase_qty).toFixed(2));
        $tax_rate.val(taxRate);
        $up_after_tax.val(Number(Number($up_before_tax.val()) + Number(taxRate)).toFixed(2));
        $subtotal_up_after_tax.val(Number(Number($subtotal_up_before_tax.val()) + Number(totaltaxRate)).toFixed(2));
        let profit_amount = Number(Number((Number($up_after_tax.val()) * Number($profit_percent.val()))/100)).toFixed(2);
        let un_sell_price = Number((Number(profit_amount) + (Number($up_after_tax.val()) + Number(profit_amount))));
        $un_sell_price.val(un_sell_price.toFixed(2));
        $total_sell_price.val((un_sell_price*$purchase_qty).toFixed(2));
    }
    function calc_total(){
        var sum = 0;
        $("table.product-table>tbody>tr>td input[id='total_sell_price']").each(function(){
            sum += Number($(this).val());
        });
        purchasesubAmount.text(sum.toFixed(2));
        purchaseAmount.text(sum.toFixed(2));
        $("input[name='pur_sub_total']").val(sum.toFixed(2));
        $("input[name='pur_total']").val(sum.toFixed(2));

    }
    function proDeleteRow(here){
        here.parents('tr').remove();
        calc_total()
    }

    $(function() {
        $("#search_product").autocomplete({
            source: function(request, response) {
                var optionData = request.term;
                $.ajax({
                    method: 'GET',
                    url: "{{ route('backend.itemconfig.item.index') }}",
                    data: {'optionData': optionData},
                    success: function(res) {
                        var resArray = $.map(res.data, function(obj) {
                            return {
                                value:  obj.name, //Fillable in input field
                                value_id:  obj.id, //Fillable in input field
                                label: 'Name:' + obj.name + ' sku:' + obj.sku, //Show as label of input fieldname: obj.name, mobile: obj.mobile
                            }
                        })
                        response(resArray);
                    }
                });
            }
            , minLength: 3
            , select: function(event, ui) {
                // item data
                $.ajax({
                    type: "GET",
                    url:"{{ route('backend.itemconfig.getAjax.itemInfo') }}",
                    dataType: "html",
                    data: {
                        item_id: ui.item.value_id,
                    },
                    success: function(res) {
                        $('table.product-table>tbody>tr:first').after(res);
                    }

                });

            }
        });

        // supplier data
        $.ajax({
            type: "GET",
            url:"{{ route('backend.supplier.index') }}",
            dataType: 'JSON',
            data: {
                optionData: true
            },
            success: function(res) {
                $.map(res.data, function(val, i) {
                    var newOption = new Option(val.name+' ('+val.mobile+')', val.id, false, false);
                    $('#supplier_id').append(newOption).trigger('change');
                });
            }
        });

        // tax data
        $.ajax({
            type: "GET",
            url:"{{ route('backend.siteConfig.tax-rate.index') }}",
            dataType: 'JSON',
            data: {
                optionData: true
            },
            success: function(res) {
                $.map(res.data, function(val, i) {
                    var newOption = new Option(val.name+' ('+val.mobile+')', val.id, false, false);
                    $('#purchase_tax').append(newOption).trigger('change');
                });
            }

        });
        // warehouse
        $.ajax({
            type: "GET",
            url:"{{ route('backend.inventory.warehouse.index') }}",
            dataType: 'JSON',
            data: {
                optionData: true
            },
            success: function(res) {
                $.map(res.data, function(val, i) {
                    var newOption = new Option(val.name+' ('+val.city+')', val.id, false, false);
                    $('#warehouse_id').append(newOption).trigger('change');
                });
            }

        });

    });



</script>
@endpush
