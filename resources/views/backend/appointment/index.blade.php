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
<i class="fa fa-list"></i> Appointment List
@stop
@section('content')

@include('backend._partials.modal_page_header', [
'fa' => 'fa fa-plus-circle',
'name' => 'Create Appointment',
'modelName' => 'create_data',
'route' => route('backend.appointment.create')
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
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($appointmentDatas as $key => $appointmentData)
                            <tr class="text-center">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $appointmentData->invoice_number }}</td>
                                <td>{{ date('d-m-Y', strtotime($appointmentData->appointment_date)) }}</td>
                                <td>{{ optional($appointmentData->patient)->name }}</td>
                                <td>{{ optional($appointmentData->doctor)->first_name }}</td>
                                <td>{{ ($appointmentData->appointment_status) }}</td>
                                <td>{{ number_format($appointmentData->doctor_fee, 2) }}</td>
                                <td>{{ ($appointmentData->paymentHistories()->pluck('payment_method')) }}</td>

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
            <form class="needs-validation" id="appointment_add_form" action="{{ route('backend.appointment.store') }}" method="Post" enctype="multipart/form-data">
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
                                    'placeholder' => 'Select Patient By Name/ID/Mobile...'
                                    ])
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#patient_modal">
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
                                @include('components.backend.forms.select2.option', [
                                'label' => 'doctor',
                                'name' => 'doctorID',
                                'optionDatas' => $doctors,
                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.input.input-type', [
                                'name' => 'doctor_fees',
                                'readonly' => 'true',
                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.input.input-type', [
                                'name' => 'appointment_date',
                                'type' => 'date',
                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.select2.option', [
                                'name' => 'appointment_schedule',
                                'optionDatas' => [],
                                'required' => 'true',
                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.select2.option', [
                                'name' => 'appointment_priority',
                                'optionDatas' => $appointment_priority,
                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.select2.option', [
                                'name' => 'payment_method',
                                'optionDatas' => $paymentSystems,
                                'required' => 'true',
                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.select2.option', [
                                'name' => 'status',
                                'optionDatas' => $appointment_status,
                                'selectedKey' => '1',
                                'required' => 'true',
                                ])
                            </div>
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
<div class="modal fade patient_modal" id="patient_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role=" document">
        <div class="modal-content">
            <form class="needs-validation" id="patient_add_form" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="modal-header">
                    <h4 class="title" id="">New Patient</h4>
                </div>

                <div class="modal-body">
                    <div class="form-validation">
                        <div class="row">
                            <div class="col-4">
                                @include('components.backend.forms.input.input-type', [
                                'name' => 'name',
                                'required' => 'true',
                                'placeholder' => 'Enter Name'
                                ])

                            </div>

                            <div class="col-4">
                                @include('components.backend.forms.input.input-type', [
                                'name' => 'mobile',
                                'required' => 'true',
                                'number' => true,
                                'placeholder' => 'Enter Mobile'
                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.input.input-type', [
                                'name' => 'email',
                                'placeholder' => 'Enter Email'
                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.input.input-type', [
                                'name' => 'emargency_contact',
                                'placeholder' => 'Enter Emargency Contact'
                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.input.input-type', [
                                'name' => 'guardian_name',
                                'placeholder' => 'Enter Guardian Name'

                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.select2.option', [
                                'name' => 'gender',
                                'optionDatas' => $genders,
                                ])
                            </div>

                            <div class="col-4">
                                @include('components.backend.forms.input.input-type', [
                                'name' => 'dob',
                                'type' => 'date',
                                'id' => 'date_of_birth',
                                ])
                            </div>
                            {{-- <div class="col-4">
                                @include('components.backend.forms.input.input-type', [
                                    'name' => 'Age ',
                                    'readonly' => 'true',
                                    'id' => 'age',
                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.select2.option', [
                                    'name' => 'symptoms_type',
                                    'optionDatas' => [],
                                    'required' => 'true',
                                ])
                            </div>--}}
                            <div class="col-4">
                                @include('components.backend.forms.select2.option', [
                                'name' => 'blood_group',
                                'optionDatas' => $blood_group,
                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.select2.option', [
                                'name' => 'marital_status',
                                'optionDatas' => $marital_status,
                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.input.input-type', [
                                'name' => 'address',
                                'placeholder' => 'Enter Address'
                                ])
                            </div>
                            {{-- <div class="col-4">
                                @include('components.backend.forms.input.input-type', [
                                    'name' => 'any_known_allergies',
                                    'placeholder' => 'Enter Any Known Allergies'
                                ])
                            </div> --}}
                            {{-- <div class="col-4">
                                @include('components.backend.forms.input.input-type', [
                                    'name' => 'Weight',
                                    'placeholder' => 'Enter Weight'
                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.input.input-type', [
                                    'name' => 'Blood Pressure',
                                    'placeholder' => 'Ex: 120/80'
                                ])
                            </div> --}}
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">SAVE</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
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
            url: url
            , type: 'GET'
            , dataType: "json"
            , success: function(response) {
                $('.appointment_modal #appointment_add_form .modal-body .col-4 #doctor_fees').val(Number(response).toFixed(2));
            }
        });
    });

    // $(function() {
    $("#patientId").autocomplete({
        source: function(request, response) {
            var optionData = request.term;
            $.ajax({
                method: 'GET'
                , url: "{{ route('backend.patient.index') }}"
                , data: {
                    'optionData': optionData
                }
                , success: function(res) {
                    var resArray = $.map(res.data, function(obj) {
                        return {
                            value: obj.name, //Fillable in input field
                            value_id: obj.id, //Fillable in input field
                            label: 'Name:' + obj.name + ' mobile:' + obj.mobile, //Show as label of input fieldname: obj.name, mobile: obj.mobile
                        }
                    })
                    response(resArray);
                }
            });
        }
        , minLength: 3
        , select: function(event, ui) {
            // patient_Id data
            $('#patient_Id').val(ui.item.value_id);


        }
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
        var url = "{{ route('backend.doctor.show',':doctor_id') }}";
        url = url.replace(':date', date);
        url = url.replace(':doctor_id', doctor_id);
        $.ajax({
            url: url
            , type: 'GET'
            , dataType: "json"
            , data: {
                'date': date
                , 'slot': true
            , }
            , success: function(response) {
                if (response.data.length != 0) {
                    response.data.forEach(element => {
                        $('#appointment_schedule').append('<option value="' + element.id + '">' + element.start_time + ' -- ' + element.end_time + '</option>')
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
            name: form.find('#name').val()
            , mobile: form.find('#mobile').val()
            , email: form.find('#email').val()
            , address: form.find('#address').val()
            , blood_group: form.find('#blood_group').val()
            , marital_status: form.find('#marital_status').val()
            , emergency_contact: form.find('#emargency_contact').val()
            , guardian_name: form.find('#guardian_name').val()
            , gender: form.find('#gender').val()
            , dob: form.find('#date_of_birth').val()
        , };
        $.ajax({
            url: url
            , type: method
            , data: data
            , success: function(response) {
                if (response.status_code == 200) {
                    $('#patientId').val(response.data.name);
                    $('#patient_Id').val(response.data.id);
                    $('.patient_modal').modal('hide');
                }
            }
            , error: function(response) {}
        });
    });

</script>


@endpush
