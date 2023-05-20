@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">

@endpush
@section('page-header')
    <i class="fa fa-list"></i> Doctor Income Summary
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

            <div class="card">
                <div class="body">
                    <h4 class="pointer text-info" id="toggleFilter">
                        <i class="fa fa-filter"></i> Filter
                    </h4>
                    <form action="{{ route('backend.paymentdoctor.index') }}" method="get">
                        @method('GET')
                        <div id="filterContainer">
                            <hr>
                            <div class="row align-items-center">

                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        @include('components.backend.forms.select2.option', [
                                            'label' => 'Select Department',
                                            'name' => 'department_id',
                                            'optionData' => $department,
                                            'selectedKey' => request()->get('department_id'),
                                        ])
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        @include('components.backend.forms.select2.option', [
                                            'label' => 'Select Doctor',
                                            'name' => 'doctor_id',
                                            'optionData' => $doctor,
                                            'selectedKey' => request()->get('doctor_id'),
                                        ])
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        @include('components.backend.forms.input.submit-button', [
                                            'name' => 'submit',
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card border-top">
                @yield('table_header')

                <div class="body">
                    @if (request()->get('doctor_id'))
                    <div class="d-flex justify-content-between">
                        <div></div>
                        <h5>Doctor Income Ledger</h5>

                        <a href="{{ route('backend.paymentdoctor.show', request()->get('doctor_id')) }}" target="_blank">
                            <button class="btn btn-warning">
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Doctor Ledger History</button>
                        </a>

                    </div>
                    @endif


                    <div class="table-responsive">
                        <table class="table table-bordered " id="">
                            <thead>
                                <tr>
                                    <th class="text-center">Doctor Name </th>
                                    <th class="text-center">Debit</th>
                                    <th class="text-center">Credit</th>
                                    <th class="text-center">Balance</th>
                                </tr>
                            </thead>
                            @if (request()->get('doctor_id'))
                                <tr>
                                    <td  class="text-center">{{ $history->first_name . ' ' . $history->last_name }}</td>
                                    <td class="text-right">{{ number_format(optional($history->ledger)->debit??0, 2) }}</td>
                                    <td class="text-right">{{ number_format(optional($history->ledger)->credit??0, 2) }}</td>
                                    <td class="text-right">{{ number_format(optional($history->ledger)->balance??0, 2) }}</td>
                                </tr>
                            @endif

                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('assets/backend/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('#start_date').datepicker({
            format: 'mm/dd/yyyy',
            startDate: '-5y'

        });
        $('#end_date').datepicker({
            format: 'mm/dd/yyyy',
            startDate: '-5y'

        });
        $(document).on('change', '#department_id', function(e) {
            e.preventDefault();
            var department_id = $(this).val();
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                dataType: "Json",
                url: "{{ route('backend.doctor.index') }}",
                data: {
                    department_id: department_id
                },
                success: function(res) {
                    $('#doctor_id').html(' ');
                    $.map(res.data, function(val, i) {
                        var newOption = new Option('-select Doctor-', null, false, false);
                        var newOption = new Option(val.name, val.id, false, false);
                        $('#doctor_id').append(newOption);

                    });
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    console.log(msg);
                },
            });
        })
    </script>
@endpush
