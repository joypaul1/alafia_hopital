@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@section('page-header')
    <i class="fa fa-list"></i> Presription List
@stop
@push('css')
<link rel="stylesheet" href="{{ asset('assets/backend/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">

@endpush
@section('content')

@include('backend._partials.page_header', [
    'fa' => 'fa fa-plus-circle',
    'name' => 'Create Prescription',
    'route' => route('backend.prescription.create')
 ])


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <h4 class="pointer text-info" id="toggleFilter">
                    <i class="fa fa-filter"></i> Filter
                </h4>
                <form action="{{ route('backend.prescription.index') }}" method="get">
                    @method('GET')
                    <div id="filterContainer">
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="invoice_no">Prescription No. </label>
                                    <input type="text" name="invoice_no" id="invoice_no" class="form-control"
                                        autocomplete="off" placeholder="invoice number"
                                        value="{{ request()->get('invoice_no') }}" autofocus='true'>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="patient_id">Patient Id </label>
                                    <input type="text" name="patient_id" id="patient_id" class="form-control"
                                        autocomplete="off" value="{{ request()->get('patient_id') }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="patient_name">Patient Name </label>
                                    <input type="text" name="patient_name" id="patient_name" class="form-control"
                                        autocomplete="off" value="{{ request()->get('patient_name') }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="mobile_number">Patient Mobile No. </label>
                                    <input type="text" name="mobile_number" id="mobile_number" class="form-control"
                                        autocomplete="off" value="{{ request()->get('mobile_number') }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label>Appointment Start Date</label>
                                <div class="input-group mb-3">
                                    <input value="{{ request()->get('start_date') ?? date('d-m-y') }}"
                                        autocomplete="off" data-provide="datepicker" data-date-autoclose="true"
                                        id="start_date" name="start_date" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <label> Appointment End Date</label>
                                <div class="input-group mb-3">
                                    <input value="{{ request()->get('end_date') ?? date('d-m-y') }}" autocomplete="off"
                                        data-provide="datepicker" data-date-autoclose="true" id="end_date"
                                        name="end_date" class="form-control">
                                </div>
                            </div>
                            {{-- <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        @include('components.backend.forms.select2.option', [
                                            'label' => 'Payment Status',
                                            'name' => 'payment_status',
                                            'optionData' => $payment_status,
                                            'selectedKey' => request()->get('payment_status'),
                                        ])
                                    </div>
                                </div> --}}
                            <div class="col-12">
                                <div class="form-group">
                                    @include('components.backend.forms.input.submit-button', [
                                        // 'label' => 'status',
                                        'name' => 'submit',
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="body">
                <div class="table-responsive ">
                    <table ellspacing='0' class="table table-bordered text-center dataTable" id="prescription_table">
                        <thead>
                            <tr >
                                <th class="text-center" >Sl.</th>
                                <th class="text-center">Action</th>
                                <th class="text-center">Pres. Number</th>
                                <th class="text-center">App. Date</th>
                                <th class="text-center">Patient</th>
                                <th class="text-center">Doctor</th>
                                {{-- <th >Next Visit</th> --}}
                                <th >Symptoms</th>


                            </tr>
                        </thead>
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
        format: 'dd-mm-yyyy',
        startDate: '-5y'

    });
    $('#end_date').datepicker({
        format: 'dd-mm-yyyy',
        startDate: '-5y'

    });
</script>
<script>
    $('#toggleFilter').click(() => {
        $('#filterContainer').slideToggle();
    })
    let table_name =  $("#prescription_table");
    $(function () {
        table_name.DataTable({
            dom: "Bfrtip",
            buttons: ["colvis","copy", "csv", "excel", "pdf", "print",
                {
                    text: 'Reload',
                    action: function ( e, dt, node, config ) {
                        dataBaseCall();
                    }
                }
            ],
            processing: true,
            serverSide: true,
            destroy: true,
            pageLength: 25,
            ajax: {
                method: 'GET',
                url: "{{ route('backend.prescription.index') }}",
                data: function(d) {
                    d.invoice_no = $('#invoice_no').val();
                    d.patient_name = $('#patient_name').val();
                    d.mobile_number = $('#mobile_number').val();
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                },
            },

            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'invoice_number', name: 'invoice_number' },
                { data: 'date', name: 'date' },
                { data: 'patient_id', name: 'patient_id' },
                { data: 'doctor_id', name: 'doctor_id' },
                // { data: 'next_visit', name: 'next_visit' },
                { data: 'symptoms', name: 'symptoms' },

            ],
        });
    });
    $(document).on('input', '#invoice_no', function() {
        dataBaseCall();
    });
    $(document).on('input', '#patient_name', function() {
        dataBaseCall();
    });
    $(document).on('input', '#mobile_number', function() {
        dataBaseCall();
    });
    $(document).on('change', '#start_date', function() {
        dataBaseCall();
    });
    $(document).on('change', '#end_date', function() {
        dataBaseCall();
    });
    function dataBaseCall(){
        table_name.DataTable().draw(true);

    }
</script>
@endpush
