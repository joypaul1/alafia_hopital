@extends('backend.layout.app')
@include('backend._partials.datatable__delete')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/backend/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
@endpush

@section('page-header')
<i class="fa fa-list"></i> Profit Report
@stop

@section('table_header')
<h3 class="text-center">Profit Statement</h3>
@stop
@section('content')


<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="body">
                <h4 class="pointer text-info" id="toggleFilter">
                    <i class="fa fa-filter"></i> Filter
                </h4>
                <form  method="get">
                    <div id="filterContainer">
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-sm-6">
                                <label>Start Date</label>
                                <div class="input-group mb-3">
                                    <input type="date" value="{{date('Y-m-d')}}" autocomplete="off" data-provide="datepicker" data-date-autoclose="true" id="start_date"  name="start_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <label>End Date</label>
                                <div class="input-group mb-3">
                                    <input type="date" value="{{date('Y-m-d')}}"  autocomplete="off" data-provide="datepicker" data-date-autoclose="true" id="end_date"  name="end_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <label>&nbsp;</label>
                                @include('components.backend.forms.input.submit-button',['positon'=>'text-left']);
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card border-top">
            @yield('table_header')
            <div class="body">
                <table class="table table-striped table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Details</th>
                            <th scope="col" class="text-center" colspan="3">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>
                                    Net Sales
                                </strong>
                            </td>
                            <td></td>
                            <th class="text-right"><u>{{number_format($netSell, 2)}}</u></th>
                            <td></td>

                        </tr>

                        <tr>
                            <td colspan="2" style="text-align: right;">
                                <strong>Gross Profit</strong>
                            </td>
                            <td></td>
                            <th colspan="" class="text-right" style="background-color: greenyellow">
                                {{number_format($netSell, 2)}}
                            </th>
                        </tr>

                        <tr>
                            <td>
                                <strong>Operating Income</strong>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @php
                            $ledgerBalance = 0.00;
                        @endphp
                        @forelse ($othersIncome->groups as $group )
                            @foreach ($group->ledgers as $ledger)
                                <tr>
                                    <td>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
                                        {{$ledger->name}}
                                    </td>
                                    @if(optional($ledger->transaction)->balance < 0)
                                    @php
                                        $ledgerBalance += optional($ledger->transaction)->balance*-1;
                                    @endphp
                                        <td class="text-right">{{number_format(optional($ledger->transaction)->balance*-1, 2)}}</td>
                                    @else
                                    @php
                                        $ledgerBalance += optional($ledger->transaction)->balance;
                                    @endphp
                                        <td class="text-right">{{number_format(optional($ledger->transaction)->balance, 2)}}</td>

                                    @endif
                                    <td></td>
                                </tr>
                            @endforeach
                        @empty

                        @endforelse


                        <tr>
                            <th colspan="" style="text-align: right;">Total Operating Income</th>
                            <td></td>
                            <th class="text-right"><u>{{number_format($ledgerBalance ,2)}}</u></th>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right;"></td>
                            <td></td>
                            <th  style="background-color: greenyellow" class="text-right">{{number_format($ledgerBalance ,2)}}</th>
                        </tr>

                    </tbody>
                    <tfoot>
                        @php
                            $total = $netSell + $ledgerBalance;
                        @endphp
                        <tr>
                            <th colspan='3' class="text-right">
                                <strong>Total Income</strong>
                            </th>
                            <th  class="text-right">
                                <u>{{number_format($total, 2)}}</u>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')






@endpush
