@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@section('page-header')
    <i class="fa fa-history"></i> Doctor Balance History
@stop
@section('table_header')
    @include('backend._partials.page_header', [
        // 'fa' => 'fa fa-check-circle',
        // 'name' => 'Doctor Income History',
        // 'route' => route('backend.pathology.labTest.index'),
    ])
@stop
@section('content')


    <div class="row">

        <div class="col-12">


            <div class="card border-top">
                @yield('table_header')

                <div class="body">

                    <div class="d-flex justify-content-center">
                        <h5>Doctor Payment history <i class="fa fa-history" aria-hidden="true"></i></h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Date</th>
                                    <th class="text-center"> Received Method</th>
                                    <th class="text-center" width="40%">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctor->withdraw as $withdrawData)
                                    <tr>
                                        <td class="text-center">{{ date('d-m-Y H:i a', strtotime($withdrawData->date)) }}
                                        </td>
                                        <td class="text-center">{{ optional($withdrawData->paymentMethod)->name ?? ' ' }}</td>
                                        <td class="text-right font-weight-bold">
                                            {{ number_format($withdrawData->amount, 2) ?? ' ' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-right font-weight-bold">Total Payment : </td>
                                    <td class="text-right font-weight-bold">
                                        {{ number_format($doctor->withdraw->sum('amount'), 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="body">

                    <div class="d-flex justify-content-center">
                        <h5>Doctor Appointment History <i class="fa fa-history" aria-hidden="true"></i></h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Total Appointment </th>
                                    <th class="text-center"> Paid Amount</th>
                                </tr>
                            </thead>
                            <tbody>

                                    <tr>
                                        <td class="text-center">{{ count($appointment) }}</td>
                                        <td class="text-right font-weight-bold"> {{ number_format(optional($doctor->ledger)->debit??0, 2) }}</td>
                                    </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-right font-weight-bold">Balance : </td>
                                    <td class="text-right font-weight-bold">
                                        {{ number_format(optional($doctor->ledger)->balance??0, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

@endpush
