@extends('backend.layout.app')

@section('page-header')
<i class="fa fa-list"></i> Prefix List
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => '',
'route' =>'#'
])


<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-body">
                <div class="form-validation">
                    <form class="needs-validation" action="{{ route('backend.siteconfig.prefix-system.store') }}" method="Post" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'purchase', 'value' =>Session('invoice_prefix')['purchase']??'', 'placeholder' => 'Purchase will be here...',  ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'purchase_return','value' =>Session('invoice_prefix')['purchase']??''  ,'placeholder' => 'Purchase Returns will be here...',  ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'purchase_qequisition', 'placeholder' => 'Purchase Requisition will be here...',  ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'purchase_order', 'placeholder' => 'Purchase Order will be here...',  ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div> --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'sell', 'value' =>Session('invoice_prefix')['sell']??'' ,'placeholder' => 'Sell will be here...',  ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'sell_return',  'value' =>Session('invoice_prefix')['sell_return']??'' , 'placeholder' => 'Sell Return will be here...',  ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'stock_transfer',  'value' =>Session('invoice_prefix')['stock_transfer']??' ', 'placeholder' => 'Stock Transfer will be here...',  ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'stock_adjustment',  'value' =>Session('invoice_prefix')['stock_adjustment']??' ', 'placeholder' => 'Stock Adjustment will be here...',  ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'expense', 'value' =>Session('invoice_prefix')['expense']??' ', 'placeholder' => 'Expenses will be here...',  ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'supplier', 'value' =>Session('invoice_prefix')['supplier']??' ', 'placeholder' => 'Supplier will be here...',  ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'Purchase_Payment', 'placeholder' => 'Purchase Payment will be here...',  ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'Sell_Payment', 'placeholder' => 'Purchase Payment will be here...',  ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'expense_payment', 'placeholder' => 'Expense Payment will be here...',  ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div> --}}
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'customer',  'value' =>Session('invoice_prefix')['customer']??' ', 'placeholder' => 'Customer will be here...',  ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'subscription_no', 'value' =>Session('invoice_prefix')['subscription_no']??' ' , 'placeholder' => 'Subscription No. will be here...',  ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'draft',  'value' =>Session('invoice_prefix')['draft']??' ' , 'placeholder' => 'Draft will be here...'])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'order', 'placeholder' => 'Sales Order will be here...'])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div> --}}
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')



@endpush