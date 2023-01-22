@extends('backend.layout.app')

{{-- @section('page-header')
<i class="fa fa-plus-circle"></i> Supplier Create
@stop --}}

@section('content')
{{-- @include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Supplier List',
'route' => route('backend.supplier.index')
]) --}}

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

<div class="row">
    <div class="col-lg-12">
        {{-- <form class="needs-validation" action="{{ route('backend.supplier.store') }}" method="Post" enctype="multipart/form-data">
            @method('POST')
            @csrf --}}
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
                                    @include('components.backend.forms.select2.option',[ 'name' => 'outlet_location', 'required'=>true, 'optionDatas' => [] ])
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
                                <th class="text-center" scope="col">Date</th>
                                <th class="text-center" scope="col">Transation Type</th>
                                <th class="text-center" scope="col">Payment Method</th>
                                <th class="text-center" scope="col">Payment Account</th>
                                <th class="text-center" scope="col">Debit</th>
                                <th class="text-center" scope="col">Credit</th>
                                <th class="text-center" scope="col">
                                    Account Balance
                                    <i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="top" title="Total balance of the particular account"></i>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $balance= 0;
                            @endphp
                            @forelse ($cashFlows as $cashFlow)
                            @php
                                $balance +=optional($cashFlow->cashflowHistory)->balance ;
                            @endphp
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($cashFlow->date))   }}</td>
                                <td>{{ $cashFlow->cashflow_type }}</td>

                                <td>{{ optional($cashFlow->method)->name }}</td>
                                <td>{{ optional($cashFlow->ledger)->name }}</td>

                                <td class="text-right">{{  number_format(optional($cashFlow->cashflowHistory)->debit, 2) }}</td>
                                <td class="text-right">{{  number_format(optional($cashFlow->cashflowHistory)->credit, 2) }}</td>
                                <td class="text-right">{{  number_format($balance, 2) }}</td>


                            </tr>
                            @empty

                            @endforelse


                            <tr>
                                <th class="text-right"  colspan="6">Total : </th>
                                <th class="text-right" > {{  number_format($balance, 2)  }}
                                @if ($balance > 0)
                                (DR)
                                @else
                                (CR)

                                @endif
                                </th>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- <div class="form-group">
                @include('components.backend.forms.input.submit-button')
            </div> --}}

        {{-- </form> --}}
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
