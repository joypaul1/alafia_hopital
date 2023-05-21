@extends('backend.layout.app')
@include('backend._partials.datatable__delete')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
@endpush

@section('page-header')
    <i class="fa fa-list"></i> Patient Visit Report
@stop

@section('table_header')
    {{-- @include('backend._partials.page_header', [
'fa' => 'fa fa-list',
// 'name' => 'Create Order',
// 'modelName' => 'create_data',
'route' => route('backend.order.order-list.index')
]) --}}

@stop
@section('content')


    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="body">
                    <h4 class="pointer text-info" id="toggleFilter">
                        <i class="fa fa-filter"></i> Filter
                    </h4>
                    <form action="{{ route('backend.report.doctorWisePatientVisit') }}" method="get">
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
                                            // 'required' => true
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
                                            'required' => true

                                        ])
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <label>Start Date <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input value="{{ date('y-m-d') }}" autocomplete="off" data-provide="datepicker"
                                            data-date-autoclose="true" id="start_date" name="start_date"
                                            class="form-control" required>

                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6">
                                    <label>End Date <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input value="{{ date('y-m-d') }}" autocomplete="off" data-provide="datepicker" required
                                            data-date-autoclose="true" id="end_date" name="end_date" class="form-control">

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

            <div class="card top_counter col-3">
                <div class="body">
                    <div class="icon"><i class="fa fa-wheelchair"></i> </div>
                    <div class="content">
                        <div class="text">First Time Visit</div>
                        <h5 class="number">{{ $firstVisit }}</h5>
                    </div>
                </div>
            </div>
            <div class="card top_counter col-3">
                <div class="body">
                    <div class="icon"><i class="fa fa-wheelchair"></i> </div>
                    <div class="content">
                        <div class="text">2nd Time Visit</div>
                        <h5 class="number">{{ $secondVisit }}</h5>
                    </div>
                </div>
            </div>
            <div class="card top_counter col-3">
                <div class="body">
                    <div class="icon"> <i class="fa fa-user-md" aria-hidden="true"></i> </div>
                    <div class="content">
                        <div class="text">Total Appointment</div>
                        <h5 class="number">{{ count($history) }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal HTML -->

    <div class="modal fade Order_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg"" role=" document">

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
        });
    </script>
@endpush
