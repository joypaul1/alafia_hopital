@extends('backend.layout.app')

@section('page-header')
<i class="fa fa-plus-circle"></i> Supplier Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Supplier List',
'route' => route('backend.supplier.index')
])

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

<div class="row">
    <div class="col-lg-12">
        <form class="needs-validation" action="{{ route('backend.supplier.store') }}" method="Post" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="card">
                <div class="body">
                    <h4 class="pointer text-info" id="toggleFilter">
                        <i class="fa fa-filter"></i> Filter
                    </h4>
                    <div id="filterContainer">
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'account', 'required'=>true, 'optionDatas' => [] ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'business_location', 'required'=>true, 'optionDatas' => [] ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label class="col-form-label">Date Range: </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="dateRangePicker" name="dates" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label class="col-form-label">Transaction Type: </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-exchange" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <select class="form-control">
                                        <option value="all">All</option>
                                        <option value="debit">Debit</option>
                                        <option value="credit">Credit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Account</th>
                                <th scope="col">Description</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Payment details</th>
                                <th scope="col">Debit</th>
                                <th scope="col">Credit</th>
                                <th scope="col">
                                    Account Balance
                                    <i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="top" title="Total balance of the particular account"></i>
                                </th>
                                <th scope="col">
                                    Total Balance
                                    <i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="top" title="Total balance of all the account"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>09/03/2022 05:36</td>
                                <td>Cash</td>
                                <td>Sell
                                    <br>
                                    <strong>Customer:</strong> Walk-In Customer
                                    <br>
                                    <strong>Invoice No:</strong> AS0007
                                    <br>
                                    <strong>Pay reference no:</strong> SP2022/0002
                                    <br>
                                    <strong>Added By:</strong> Mr Admin
                                </td>
                                <td>Cash</td>
                                <td></td>
                                <td></td>
                                <td>$ 1,125.00</td>
                                <td>$ 1,125.00</td>
                                <td>$ 1,125.00</td>
                            </tr>

                            <tr>
                                <th colspan="5">Total</th>
                                <th> $ 0.00 </th>
                                <th> $ 1,125.00 </th>
                                <th colspan="2"></th>
                            </tr>
                        </tbody>
                    </table>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(document).ready(() => {
        $('#toggleFilter').click(() => {
            $('#filterContainer').slideToggle();
        })
    })
    $(document).ready(() => {
        $('#dateRangePicker').daterangepicker();
    })
</script>
@endpush
