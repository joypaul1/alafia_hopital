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
                                    @include('components.backend.forms.select2.option',[ 'name' => 'account', 'required'=>true, 'optionData' => [] ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'business_location', 'required'=>true, 'optionData' => [] ])
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
                            {{-- <div class="col-lg-3 col-md-6">
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
                            </div> --}}
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
                                <th class="text-center" scope="col">Particulars</th>
                                <th class="text-center" scope="col">Reference NO.</th>
                                <th class="text-center" scope="col">Debit</th>
                                <th class="text-center" scope="col">Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $debit = 0;
                                $credit = 0;
                            @endphp
                            @forelse ($daybooks as $daybook)
                                <tr>
                                    <th scope="row">{{ date('d-m-Y', strtotime($daybook->date))}}</th>
                                    <td>
                                        @forelse ($daybook->transactionHistories as $transaction)
                                            @php
                                                $debit+= $transaction->debit;
                                                $credit+= $transaction->credit;
                                            @endphp
                                           {{$transaction->entry_name}} <br>
                                           @if ($transaction->credit>0)
                                           &nbsp; &nbsp; &nbsp;
                                           @endif
                                        @empty

                                        @endforelse
                                       ( {{$daybook->transaction_type}})

                                    </td>
                                    <td></td>
                                    <td class="text-right">
                                        @forelse ($daybook->transactionHistories as $transaction)

                                           {{$transaction->debit > 0? number_format($transaction->debit, 2): ' '}} <br>

                                        @empty

                                        @endforelse

                                    </td>
                                    <td class="text-right">
                                        @forelse ($daybook->transactionHistories as $transaction)
                                           {{$transaction->credit > 0? number_format($transaction->credit, 2): ' ' }}<br>
                                        @empty

                                        @endforelse
                                    </td>
                                </tr>
                            @empty

                            @endforelse


                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="row"></th>
                                <td>

                                </td>
                                <td></td>
                                <td class="text-right">
                                    <span style="border-bottom:3px double rgba(51, 51, 51, 0.596);">{{ number_format($debit, 2) }}</span>
                                </td>
                                <td class="text-right">
                                    <span style="border-bottom:3px double rgba(51, 51, 51, 0.596);">{{ number_format($credit, 2) }}</span>
                                </td>
                            </tr>
                        </tfoot>
                </div>
            </div>




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
