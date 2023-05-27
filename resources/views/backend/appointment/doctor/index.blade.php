@extends('backend.layout.app')
@include('backend._partials.datatable__delete')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        .ui-widget.ui-widget-content {
            z-index: 99999999;
        }
    </style>
@endpush

@section('page-header')
    <i class="fa fa-list"></i>Doctor Appointment List
@stop
@section('content')
@section('table_header')
    @include('backend._partials.modal_page_header', [
        'fa' => 'fa fa-plus-circle',
        'name' => 'Create Appointment',
        'modelName' => 'create_data',
        'route' => route('backend.appointment.create'),
    ])
@endsection
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <h4 class="pointer text-info" id="toggleFilter">
                    <i class="fa fa-filter"></i> Filter
                </h4>
                <form action="{{ route('backend.appointment.index') }}" method="get">
                    @method('GET')
                    <div id="filterContainer">
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="invoice_no">Invoice no</label>
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
                                <label>Start Date</label>
                                <div class="input-group mb-3">
                                    <input value="{{ request()->get('start_date') ?? date('y-m-d') }}"
                                        autocomplete="off" data-provide="datepicker" data-date-autoclose="true"
                                        id="start_date" name="start_date" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <label>End Date</label>
                                <div class="input-group mb-3">
                                    <input value="{{ request()->get('end_date') ?? date('y-m-d') }}" autocomplete="off"
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
            @yield('table_header')
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center dataTable" id="appointment_table">
                        <thead>
                            <tr>
                                <th class="text-center">Sl.</th>
                                <th class="text-center">Invoice No.</th>
                                <th class="text-center">App. Date</th>
                                <th class="text-center">Patient</th>
                                <th class="text-center">Doctor</th>
                                <th class="text-center">Visit Type</th>
                                <th class="text-center">Doctor Fee</th>
                                <th class="text-center">Payment Method</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Appointment modal --}}
<div class="modal fade appointment_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role=" document">

    </div>
</div>
{{-- Patient modal --}}
<div class="modal fade patient_modal" id="patient_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role=" document">

    </div>
</div>

@endsection

@push('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
    let table_name;
    $(document).on('input', '#patientId', function() {
        $("#patientId").autocomplete({
            source: function(request, response) {
                var optionData = request.term;
                $.ajax({
                    method: 'GET',
                    url: "{{ route('backend.patient.index') }}",
                    data: {
                        'optionData': optionData
                    },
                    success: function(res) {
                        var resArray = $.map(res.data, function(obj) {
                            return {
                                value: obj.name, //Fillable in input field
                                value_id: obj.id, //Fillable in input field
                                label: 'Name:' + obj.name + ' mobile:' + obj
                                    .mobile, //Show as label of input fieldname: obj.name, mobile: obj.mobile
                            }
                        })
                        response(resArray);
                    }
                });
            },

            select: function(event, ui) {
                // patient_Id data
                $('#patient_Id').val(ui.item.value_id);


            }
        });
    });
    $(function() {
        table_name = $("#appointment_table").DataTable({
            dom: "Bfrtip",
            buttons: ["colvis", "copy", "csv", "excel", "pdf", "print",
                {
                    text: 'Reload',
                    action: function(e, dt, node, config) {
                        dataBaseCall();
                    }
                }
            ],
            processing: true,
            serverSide: true,
            destroy: true,
            pagingType: 'numbers',
            pageLength: 10,
            ajax: "{{ route('backend.appointment.index') }}",
            ajax: {
                method: 'GET',
                url: "{{ route('backend.appointment.index') }}",
                data: function(d) {
                    d.status = $('select#status').val() || true;
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'invoice_number',
                    name: 'invoice_number'
                },
                {
                    data: 'appointment_date',
                    name: 'appointment_date'
                },
                {
                    data: 'patient_id',
                    name: 'patient_id'
                },
                {
                    data: 'doctor_id',
                    name: 'doctor_id'
                },

                {
                    data: 'visitType',
                    name: 'visitType',
                },
                {
                    data: 'doctor_fee',
                    name: 'doctor_fee'
                },
                {
                    data: 'paymentHistories',
                    name: 'paymentHistories'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });


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
                $('#doctorID').html(' ');
                $.map(res.data, function(val, i) {
                    var newOption = new Option('-select Doctor-', null, false, false);
                    var newOption = new Option(val.name, val.id, false, false);
                    $('#doctorID').append(newOption);
                    getDocFee();
                    slot();

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
    // create_patient modal
    $(document).on('click', '#create_patient', function(e) {
        e.preventDefault();
        var modal = ".patient_modal";
        var href = $(this).data('href');
        // AJAX request
        $.ajax({
            url: href,
            type: 'GET',
            dataType: "html",
            success: function(response) {
                $(modal).modal('show');
                $(modal).find('.modal-dialog').html('');
                $(modal).find('.modal-dialog').html(response); // Add response in Modal body
            }
        });
    });

    $(document).on('change', '.appointment_modal #appointment_add_form .modal-body .col-4 #discount_type', function() {
        discountCal();
        paid_amount();
    });

    //discount calculation depend on discount type
    $(document).on('input', '.appointment_modal #appointment_add_form .modal-body .col-4 #discount', function() {
        discountCal();
        paid_amount();
    });


    $(document).on('input', '.appointment_modal #appointment_add_form .modal-body .col-4 #paid_amount', function() {
        paid_amount();
        // discountCal();
    })

    //discount calculation depend on discount type
    function discountCal() {
        var discount_type = $('#discount_type').val();
        var discount = $('#discount').val();
        var doctor_fee = $('#doctor_fees').val() || 0;
        var payable_amount = $('#payable_amount').val();
        if (discount_type == 'percentage') {
            var discount_amount = (Number(doctor_fee) * Number(discount)) / 100;
            var payable_amount = Number(doctor_fee) - Number(discount_amount);

            $('#discount_amount').val((discount_amount).toFixed(2));
            $('#payable_amount').val((payable_amount).toFixed(2));
        } else {
            $('#discount_amount').val(Number(discount).toFixed(2));
            var payable_amount = Number(doctor_fee) - Number(discount);
            // console.log(payable_amount);
            $('#payable_amount').val((payable_amount).toFixed(2));
        }
    }

    //paid amount calculation
    function paid_amount() {
        var paid_amount = $('#paid_amount').val();
        var payable_amount = $('#payable_amount').val();
        var due_amount = Number(payable_amount) - Number(paid_amount);
        $('#due_amount').val((due_amount).toFixed(2));
    }

    // appointment_modal
    $('#create_data').click(function(e) {
        e.preventDefault();
        var modal = ".appointment_modal";
        // $(modal).modal('show');
        var href = $(this).data('href');
        // AJAX request
        $.ajax({
            url: href,
            type: 'GET',
            dataType: "html",
            success: function(response) {
                $(modal).modal('show');
                $(modal).find('.modal-dialog').html('');
                $(modal).find('.modal-dialog').html(response); // Add response in Modal body
            }
        });

    });
    // onchange doctorID  get value and set in input field by ajax request
    $(document).on('change', '#doctorID', function() {
        getDocFee();
        slot();
    });
    $(document).on('click', '.appointment_modal #appointment_add_form .modal-body #checkReport', function() {
        if ($(this).is(":checked")) {
            $(this).val('on')
        } else {
            $(this).val('off')
        }
    })

    function getDocFee() {
        let checkReport = false
        if ($('.appointment_modal #appointment_add_form .modal-body #checkReport').is(":checked")) {
            checkReport = true
        }
        // console.log($("").val())
        var doctor_id = $('#doctorID').val();
        var url = "{{ route('backend.doctor.show', ':id') }}";
        url = url.replace(':id', doctor_id);
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                checkReport: checkReport
            },
            dataType: "json",
            success: function(response) {
                $('.appointment_modal #appointment_add_form .modal-body .col-4 #doctor_fees').val(Number(
                    response).toFixed(2));
                $('.appointment_modal #appointment_add_form .modal-body .col-4 #subtotal').val(Number(
                    response).toFixed(2));
                $('.appointment_modal #appointment_add_form .modal-body .col-4 #payable_amount').val(Number(
                    response).toFixed(2));
                discountCal();
                paid_amount();
            }
        });
    }

    // get slot time on change date by ajax request
    $(document).on('change', '#appointment_date', function() {
        slot();
    });

    // get slot time on change date by ajax request

    function slot() {
        $('#appointment_schedule').empty().trigger('change');
        $('#appointment_schedule').val(null).trigger('change');
        var date = $('#appointment_date').val();
        var doctor_id = $('#doctorID').val();
        var url = "{{ route('backend.doctor.show', ':doctor_id') }}";
        url = url.replace(':date', date);
        url = url.replace(':doctor_id', doctor_id);
        $.ajax({
            url: url,
            type: 'GET',
            dataType: "json",
            data: {
                'date': date,
                'slot': true,
            },
            success: function(response) {
                if (response.data.length != 0) {
                    response.data.forEach(element => {
                        $('#appointment_schedule').append('<option value="' + element.id + '" >' +
                            element.start_time + ' -- ' + element.end_time + '</option>')
                    });
                    $("#appointment_schedule").val($("#appointment_schedule option:first").val()).trigger(
                        'change');
                } else {
                    $('#appointment_schedule').append('<option value="">No Slot Available</option>')
                }


            }
        });
    }


    // date_of_birth
    $(document).on('change', '#date_of_birth', function(e) {
        console.log('ok');
        var today = new Date();
        var birthDate = new Date($(this).val());
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        if (isNaN(age) || age < 0) {
            age = 0;
        }
        return $('#age').val(age);
    });
    //get date of birth form age
    $(document).on('input', '#age', function(e) {
        var today = new Date();
        var birthDate = new Date(today.getFullYear() - $(this).val(), today.getMonth(), today.getDate());
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        if (isNaN(age) || age < 0) {
            age = 0;
        }
        return $('#date_of_birth').val(birthDate.toISOString().slice(0, 10));

    });
    // patient_add_form
    $(document).on('submit', '#patient_add_form', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = "{{ route('backend.patient.store') }}";
        var method = "POST";
        var data = {
            name: form.find('#name').val(),
            mobile: form.find('#mobile').val(),
            email: form.find('#email').val(),
            address: form.find('#address').val(),
            blood_group: form.find('#blood_group').val(),
            marital_status: form.find('#marital_status').val(),
            emergency_contact: form.find('#emargency_contact').val(),
            guardian_name: form.find('#guardian_name').val(),
            gender: form.find('#gender').val(),
            dob: form.find('#date_of_birth').val(),
        };
        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function(response) {
                if (response.status_code == 200) {
                    $('#patientId').val(response.data.name);
                    $('#patient_Id').val(response.data.id);
                    $('.patient_modal').modal('hide');
                }
            },
            error: function(response) {}
        });
    });
</script>
@endpush
