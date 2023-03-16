@extends('backend.layout.app')
@include('backend._partials.datatable__delete')
@push('css')
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

    @include('backend._partials.modal_page_header', [
        'fa' => 'fa fa-plus-circle',
        'name' => 'Create Appointment',
        'modelName' => 'create_data',
        'route' => route('backend.appointment.create'),
    ])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
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
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Doctor Fee</th>
                                    <th class="text-center">Payment Method</th>
                                    <th class="text-center">Actiion</th>
                                </tr>
                            </thead>

                            <tbody>
                                {{-- @foreach ($appointmentDatas as $key => $appointmentData)
                                    <tr class="text-center">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $appointmentData->invoice_number }}</td>
                                        <td>{{ date('d-m-Y', strtotime($appointmentData->appointment_date)) }}</td>
                                        <td>{{ optional($appointmentData->patient)->name }}</td>
                                        <td>{{ optional($appointmentData->doctor)->first_name }}</td>
                                        <td>{{ $appointmentData->appointment_status }}</td>
                                        <td>{{ number_format($appointmentData->doctor_fee, 2) }}</td>
                                        <td>{{ $appointmentData->paymentHistories()->pluck('payment_method') }}</td>

                                    </tr>
                                @endforeach --}}


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
                                    value: obj
                                        .name, //Fillable in input field
                                    value_id: obj
                                        .id, //Fillable in input field
                                    label: 'Name:' + obj.name +
                                        ' mobile:' + obj
                                        .mobile, //Show as label of input fieldname: obj.name, mobile: obj.mobile
                                }
                            })
                            response(resArray);
                        }
                    });
                },
                minLength: 3,
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
                        data: 'appointment_status',
                        name: 'appointment_status',
                        orderable: false,
                        searchable: false
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
                        var newOption = new Option(val.name, val.id, false, false);
                        $('#doctorID').append(newOption);
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
        })


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
            var doctor_id = $(this).val();
            var url = "{{ route('backend.doctor.show', ':id') }}";
            url = url.replace(':id', doctor_id);
            $.ajax({
                url: url,
                type: 'GET',
                dataType: "json",
                success: function(response) {
                    $('.appointment_modal #appointment_add_form .modal-body .col-4 #doctor_fees').val(
                        Number(response).toFixed(2));
                }
            });
        });



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
                            $('#appointment_schedule').append('<option value="' + element.id + '">' +
                                element.start_time + ' -- ' + element.end_time + '</option>')
                        }).trigger('change');
                    } else {
                        $('#appointment_schedule').append('<option value="">No Slot Available</option>')
                    }


                }
            });
        }

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
