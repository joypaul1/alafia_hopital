@extends('backend.layout.app')

@push('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .ui-widget.ui-widget-content {
            z-index: 99999999;
        }
    </style>
@endpush

@section('page-header')
    <i class="fa fa-list"></i>Dialysis Appointment List
@stop
@section('content')

    @include('backend._partials.modal_page_header', [
        'fa' => 'fa fa-plus-circle',
        'name' => 'Create Appointment',
        'modelName' => 'create_data',
        'route' => route('backend.dialysis-appointment.create'),
    ])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
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
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($appointmentDatas as $key => $appointmentData)
                                    <tr class="text-center">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $appointmentData->invoice_number }}</td>
                                        <td>{{ date('d-m-Y', strtotime($appointmentData->appointment_date)) }}</td>
                                        <td>{{ optional($appointmentData->patient)->name }}</td>
                                        <td>{{ optional($appointmentData->doctor)->first_name }}</td>
                                        <td>{{ $appointmentData->appointment_status }}</td>
                                        <td>{{ number_format($appointmentData->fee, 2) }}</td>
                                        <td>{{ $appointmentData->paymentHistories()->pluck('payment_method') }}</td>
                                        <td>
                                            <a
                                                href="{{ route('backend.dialysis-appointment.show', $appointmentData->id) }}">
                                                <button class="btn btn-md btn-info">View</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach


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
            <div class="modal-content">
                <form class="needs-validation" id="appointment_add_form"
                    action="{{ route('backend.dialysis-appointment.store') }}" method="Post" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="modal-header">
                        <div class="row w-100 justify-content-between">
                            <div class="col-md-6">
                                <h4 class="title" id="">Appointment</h4>
                            </div>
                            <input type="hidden" name="patient_Id" id="patient_Id" value="">
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        @include('components.backend.forms.input.input-type2', [
                                            'name' => 'patientId',
                                            'required' => 'true',
                                            'placeholder' => 'Select Patient By Name/ID/Mobile...',
                                        ])
                                    </div>
                                    <div class="col-3">
                                        {{-- <button class="btn btn-info" data-toggle="modal" data-target="#patient_modal">
                                            New Patient
                                        </button> --}}
                                        <button class="btn btn-info" data-href="{{ route('backend.patient.create') }}" id="create_patient">
                                            New Patient
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <div class="row">

                                <div class="col-4">
                                    @include('components.backend.forms.input.input-type', [
                                        'name' => 'fee',
                                        'readonly' => 'true',
                                        'value' => 5000,
                                        'required' => true,
                                    ])
                                </div>
                                <div class="col-4">
                                    @include('components.backend.forms.input.input-type', [
                                        'name' => 'appointment_date',
                                        'inType' => 'date',
                                        'value' => date('Y-m-d'),
                                        'required' => true,
                                    ])
                                </div>
                                <div class="col-4">
                                    @include('components.backend.forms.select2.option', [
                                        'name' => 'schedule',
                                        'optionData' => $appointment_schedule,
                                        'required' => true,
                                    ])
                                </div>
                                <div class="col-4">
                                    @include('components.backend.forms.select2.option', [
                                        'label' => 'Referred By',
                                        'name' => 'doctor_id',
                                        'optionData' => $doctors,
                                    ])
                                </div>
                                <div class="col-4">
                                    @include('components.backend.forms.select2.option', [
                                        'label' => 'Asign To',
                                        'name' => 'employee_id',
                                        'optionData' => $employees,
                                    ])
                                </div>
                                {{-- <div class="col-4">
                                @include('components.backend.forms.select2.option', [
                                'name' => 'appointment_priority',
                                'optionData' => $appointment_priority,
                                'selectedKey' => "Normal"
                                ])
                            </div> --}}
                                <div class="col-4">
                                    @include('components.backend.forms.select2.option', [
                                        'name' => 'payment_method',
                                        'optionData' => $paymentSystems,
                                        'required' => 'true',
                                        'selectedKey' => 1,
                                        'required' => true,
                                    ])
                                </div>
                                <div class="col-4">
                                    @include('components.backend.forms.select2.option', [
                                        'name' => 'status',
                                        'optionData' => $appointment_status,
                                        'selectedKey' => '1',
                                        'required' => 'true',
                                        'selectedKey' => 'approved',
                                        'required' => true,
                                    ])
                                </div>
                                <div class="col-4">
                                    @include('components.backend.forms.input.input-type', [
                                        'name' => 'subtotal',
                                        'readonly' => 'true',
                                        'value' => 5000,
                                    ])
                                </div>
                                <div class="col-4">
                                    @include('components.backend.forms.select2.option', [
                                        'name' => 'discount_type',
                                        'optionData' => $discountType,
                                    ])
                                </div>
                                <div class="col-4">
                                    @include('components.backend.forms.input.input-type', [
                                        'name' => 'discount',
                                        // 'readonly' => 'true',
                                        'value' => 0,
                                    ])
                                </div>
                                <div class="col-4">
                                    @include('components.backend.forms.input.input-type', [
                                        'name' => 'discount_amount',
                                        'readonly' => 'true',
                                        'value' => 0.0,
                                    ])
                                </div>

                                <div class="col-4">
                                    @include('components.backend.forms.input.input-type', [
                                        'name' => 'payable_amount',
                                        'readonly' => 'true',
                                        'value' => 5000,
                                    ])
                                </div>

                                {{-- <div class="col-4">
                                    @include('components.backend.forms.input.input-type', [
                                        'name' => 'paid_amount',
                                        'value' => 0.0,
                                    ])
                                </div>
                                <div class="col-4">
                                    @include('components.backend.forms.input.input-type', [
                                        'name' => 'due_amount',
                                        'readonly' => true,
                                        'value' => 5000,
                                    ])
                                </div> --}}
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                        <button type="submit" class="btn btn-primary save_category_button">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Patient modal --}}
        {{-- Patient modal --}}
        <div class="modal fade patient_modal" id="patient_modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role=" document">

            </div>
        </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $('#create_data').click(function(e) {
            e.preventDefault();
            var modal = ".appointment_modal";
            $(modal).modal('show');

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
                    $('.appointment_modal #appointment_add_form .modal-body .col-4 #fee').val(Number(
                        response).toFixed(2));
                }
            });
        });

        // $(function() {
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
            minLength: 3,
            select: function(event, ui) {
                // patient_Id data
                $('#patient_Id').val(ui.item.value_id);


            }
        });
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
            var fee = $('#fee').val() || 0;
            var payable_amount = $('#payable_amount').val();
            if (discount_type == 'percentage') {
                var discount_amount = (Number(fee) * Number(discount)) / 100;
                var payable_amount = Number(fee) - Number(discount_amount);
                $('#discount_amount').val((discount_amount).toFixed(2));
                $('#payable_amount').val((payable_amount).toFixed(2));
            } else {
                $('#discount_amount').val(Number(discount).toFixed(2));
                var payable_amount = Number(fee) - Number(discount);
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
