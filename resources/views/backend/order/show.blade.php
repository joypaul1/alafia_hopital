@extends('backend.layout.app')
@include('backend._partials.datatable__delete')
@push('css')

@endpush

@section('page-header')
<i class="fa fa-list"></i> Order Show
@stop

@section('table_header')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Order List',
// 'modelName' => 'create_data',
'route' => route('backend.order.order-list.index')
])

@stop
@section('content')


<div class="row">
    <div class="col-lg-12">


        <div class="card border-top">
            @yield('table_header')
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center dataTable" id="Order_table">
                        <thead>
                            <tr>
                                <th class="text-center">Order Date </th>
                                <th class="text-center">Customer </th>
                                <th class="text-center">Order Type</th>
                                <th class="text-center">Item Qty</th>
                                <th class="text-center">Coupon Amount</th>
                                <th class="text-center">Sub Total</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Status</th>
                                {{-- <th class="text-center">Status</th> --}}
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>{{date('m-d-Y', strtotime($order->date))}}</td>
                                <td>{{$order->user->name}}</td>
                                <td>{{$order->order_type}}</td>
                                <td>{{ count($order->orderItems)}}</td>
                                <td>{{ number_format($order->coupon_amount, 2) }}</td>
                                <td>{{ number_format($order->sub_total, 2) }}</td>
                                <td>{{ number_format($order->total, 2) }}</td>
                                <td>{{$order->orderStatus->status}}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card border-top">

            <div class="card d-flex clearfix mt-4 text-center">
                <div class="header">
                    <span href="#" style="font-size: 18px;font-weight:700">
                     Order Item List
                    </span>
                </div>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center dataTable" id="Order_table">
                        <thead>
                            <tr>
                                <th class="text-center">SL. </th>
                                <th class="text-center"> Item </th>
                                <th class="text-center"> Qty</th>
                                <th class="text-center"> Price</th>
                                <th class="text-center">Sub Total</th>
                                <th class="text-center">Total</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $key=>$orderitem)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$orderitem->item->name}}</td>
                                <td>{{number_format($orderitem->qty ,2)}}</td>
                                <td>{{number_format($orderitem->unit_price ,2)}}</td>
                                <td>{{number_format($orderitem->unit_price ,2)}}</td>
                                <td>{{ number_format($orderitem->subtotal, 2) }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <form action="{{ route('backend.order.order-list.store' , ['order_id' => $order->id]) }}" method="post">
                @csrf
                @method("POST")
            <div class="card border-top">
                <div class="card-body">
                    <h5>
                        Add Payment
                    </h5>
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',['name' => 'sub_total',
                                'value' => number_format($order->sub_total, 2),'readonly'=>true,
                                'placeholder' => 'Enter payable amount amount here...', ])
                                @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('payable_amount')])
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',['name' => 'service_charge',
                                'value' => number_format($order->service_charge, 2),'readonly'=>true,
                                'placeholder' => 'Enter payable amount amount here...', ])
                                @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('payable_amount')])
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',['label'=> 'Payment Amount' ,'name' => 'payment_amount',
                                'value' =>  number_format($order->total + $order->service_charge, 2),'readonly' => true,
                                'placeholder' => 'Enter amount here...', ])
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
                                <input type="date" value="{{ date('Y-m-d') }}" required name="paid_date" class="form-control"  placeholder="Paid date">
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
                                @include('components.backend.forms.select2.option2',['label'=> 'Payment Method','name' =>'payment_method','optionData' => $payment_methods, 'required' => true])
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
                                @include('components.backend.forms.select2.option2',['label' =>'Payment Account' ,'name' =>'payment_account','optionData' => $payment_accounts, 'required' => true])
                                @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('payment_account')])
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',['label'=> 'Due Amount', 'value'=>0, 'name' => 'due_amount','value'=>0 ,'readonly'=>true ,'placeholder' => 'due amount here...', ])
                                @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('due_amount')])
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="col-form-label">
                                Discount Type:
                            </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                    </span>
                                </div>
                                @include('components.backend.forms.select2.option2',['name' =>'discount_type','optionData' => $dis_status])
                                @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('discount_type')])
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',['name' => 'discount',
                                'value' =>  0,
                                'placeholder' => 'Enter discount amount here...', ])
                                @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('discount')])
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',['name' => 'discount_amount',
                                'value' =>  0,'readonly'=>true,
                                'placeholder' => 'Enter discount amount here...', ])
                                @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('discount_amount')])
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',['name' => 'payable_amount',
                                'value' => number_format($order->total, 2),'readonly'=>true,
                                'placeholder' => 'Enter payable amount amount here...', ])
                                @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('payable_amount')])
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="col-form-label">
                                Payment note:
                            </label>
                            <textarea name="payment_note" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                    </div>


                </div>
            </div>
            <div class="form-group">
                @include('components.backend.forms.input.submit-button')
            </div>
        </form>
    </div>
</div>

<!-- Modal HTML -->


@endsection

@push('js')

<script>
    $('#discount_type').on('change', function (e) {
        disCalculation();
    });
    $('#discount').on('keyup', function (e) {
        disCalculation();
    });

    function disCalculation(){
        var payment_amount  = $("#sub_total").val();
        var service_charge  = $("#service_charge").val();
        var discount        = $('#discount').val();
        var payableAmount   = 0;
        var disType         = $("#discount_type").val();
        payment_amount =    payment_amount.replace(',', '')
        service_charge =    service_charge.replace(',', '')
        console.log(payment_amount,disType, payment_amount.replace(',', '') );
        if(disType == 'percent'){
           var disAmount = (payment_amount * Number(discount))/100;
        }else{
            var disAmount = Number(discount);
        }
        console.log(disAmount);
        payableAmount = payment_amount - disAmount;
        payableAmount = payableAmount + Number(service_charge);

        $('#discount_amount').val(parseFloat(disAmount).toFixed(2));
        $('#payable_amount').val(parseFloat(payableAmount).toFixed(2));
    }
</script>

@endpush
