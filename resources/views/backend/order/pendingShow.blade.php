@extends('backend.layout.app')
@include('backend._partials.datatable__delete')
@push('css')

@endpush

@section('page-header')
<i class="fa fa-list"></i> Order Pending
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
                                <th class="text-center">Service Charge</th>
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
                                <td>{{ number_format($order->service_charge, 2) }}</td>
                                <td>{{ number_format($order->service_charge + $order->total, 2) }}</td>
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
        <form action="{{ route('backend.order.order-list-pending.store' , ['order_id' => $order->id]) }}" method="post">
            @csrf
            @method("POST")
            <div class="card border-top">
                <div class="card-body">
                    <h5>
                        Order Status
                    </h5>
                    <div class="row  ">
                        <div class="text-right justify-content-between">
                            <div class="form-group">
                                @include('components.backend.forms.select2.option2',['label'=> 'Status', 'name' =>'status','optionData' => $status])
                                @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('status')])
                            </div>
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



@endpush
