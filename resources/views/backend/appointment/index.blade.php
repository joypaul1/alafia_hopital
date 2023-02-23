@extends('backend.layout.app')

@push('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    .ui-widget.ui-widget-content{
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
                    <table

                        class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sl.</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Designation</th>
                                <th class="text-center">Created By</th>
                                <th class="text-center">Status</th>
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
        <div class="modal-content">
            <form class="needs-validation" id="appointment_add_form" action="{{ route('backend.itemconfig.category.store') }}" method="Post"
                enctype="multipart/form-data">
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
                                    <button class="btn btn-info"
                                     data-toggle="modal" data-target="#patient_modal">
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
                    <button type="submit" class="btn btn-primary save_category_button">SAVE</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Patient modal --}}
<div class="modal fade patient_modal" id="patient_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role=" document">
        <div class="modal-content">
            <form class="needs-validation" id="patient_add_form"
            action="{{ route('backend.patient.store') }}" method="Post"
                enctype="multipart/form-data">
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
                                    'name' => 'emergency_contact',
                                    'placeholder' => 'Enter Emergency Contact'
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
                url: url,
                type: 'GET',
                dataType: "json",
                success: function(response) {
                    $('.appointment_modal #appointment_add_form .modal-body .col-4 #doctor_fees').val(Number(response).toFixed(2));
                }
            });
        });

        $(function() {
            $("#patientId").autocomplete({
                source: function(request, response) {
                    var optionData = request.term;
                    $.ajax({
                        method: 'GET',
                        url: "{{ route('backend.patient.index') }}",
                        data: {'optionData': optionData},
                        success: function(res) {
                            var resArray = $.map(res.data, function(obj) {
                                return {
                                    value:  obj.name, //Fillable in input field
                                    value_id:  obj.id, //Fillable in input field
                                    label: 'Name:' + obj.name + ' mobile:' + obj.mobile, //Show as label of input fieldname: obj.name, mobile: obj.mobile
                                }
                            })
                            response(resArray);
                        }
                    });
                }
                , minLength: 3
                , select: function(event, ui) {
                    // item data
                    // ui.item.value_id,
                    $('#patient_Id').val(ui.item.value_id);
                    console.log($('#patient_Id'));


                }
            });

            // supplier data
            // $.ajax({
            //     type: "GET",
            //     url:"{{ route('backend.supplier.index') }}",
            //     dataType: 'JSON',
            //     data: {
            //         optionData: true
            //     },
            //     success: function(res) {
            //         $.map(res.data, function(val, i) {
            //             var newOption = new Option(val.name+' ('+val.mobile+')', val.id, false, false);
            //             $('#supplier_id').append(newOption).trigger('change');
            //         });
            //     }
            // });



        });


    </script>


@endpush
