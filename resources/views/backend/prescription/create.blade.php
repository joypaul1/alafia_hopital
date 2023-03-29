@extends('backend.layout.app')


@section('page-header')
    <i class="fa fa-plus-circle"></i> Prescription Create
@stop
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <style>
        .table-bordered td,
        .table-bordered th {
            border: none;
        }
    </style>
@endpush
@section('content')

    @include('backend._partials.page_header', [
        'fa' => 'fa fa-list',
        'name' => 'Prescription list',
        'route' => route('backend.prescription.index'),
    ])

    <div class="row">
        <div class="col-12">
            <form action="{{ route('backend.prescription.store') }}" method="post">
                @csrf
                @method('POST')
                <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                <div class="card">
                    <div class="body">
                        <h4>
                            Patient Information
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                @include('components.backend.forms.input.input-type2', [
                                    'name' => 'p_id',
                                    'number' => true,
                                    'placeholder' => 'Seach By Patient ID(0000001)',
                                    'required' => true,
                                    'readonly' => true,
                                    'value' => $appointment->patient->patientId,
                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.input.input-type2', [
                                    'name' => 'p_name',
                                    'placeholder' => 'Seach By Patient Name(Mr Jack)',
                                    'required' => true,
                                    'readonly' => true,

                                    'value' => $appointment->patient->name,

                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.input.input-type2', [
                                    'name' => 'p_mobile',
                                    'number' => true,
                                    'placeholder' => 'Seach By Patient Mobile(01******)',
                                    'required' => true,
                                    'readonly' => true,
                                    'value' => $appointment->patient->mobile,

                                ])
                            </div>
                            {{-- <div class="col-2">
                                @include('components.backend.forms.input.input-type2', [
                                    'name' => 'p_age',
                                    'number' => true,
                                    'placeholder' => 'Age',
                                    'required' => true,
                                ])
                            </div> --}}
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-5">
                                        @include('components.backend.forms.input.input-type2', [
                                            'name' => 'p_info[]',
                                            'placeholder' => 'Additional informarion (eg. Blood Pressure)',
                                            'required' => true,
                                            'value' => '',

                                        ])
                                    </div>
                                    <div class="col-5">
                                        @include('components.backend.forms.input.input-type2', [
                                            'name' => 'p_info_value[]',
                                            'placeholder' => 'Enter Value (eg. 120/80)',
                                            'required' => true,
                                            'value' => '',
                                        ])
                                    </div>
                                    <div class="col-2">
                                        <button type="button"  class="btn btn-info p_infoAdd">
                                            +
                                        </button>
                                        <button type="button" class="btn btn-danger p_infoRemove">
                                            -
                                        </button>
                                    </div>

                                </div>
                                <div id="addination_info" style="width:100%"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="body">
                        <h4>
                            Chief Complaints
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="col-10">
                                @include('components.backend.forms.input.input-type2', [
                                    'name' => 'symptoms_name',
                                    'placeholder' => 'Complaint',
                                    'class' => 'symptoms_name',
                                ])
                            </div>
                            <input type="hidden" id="symptoms_id" name="symptoms_id[]">
                            <div class="col-2">
                                <button type="button"  class="btn btn-info chief_add">
                                    +
                                </button>
                                <button type="button"  class="btn btn-danger chief_remove">
                                    -
                                </button>
                            </div>
                        </div>
                        <div id="chief_complaints" style="width:100%"></div>
                    </div>
                </div>

                <div class="card">
                    <div class="body">
                        <h4>
                            Any Test Required ?
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="col-5">
                                @include('components.backend.forms.input.input-type2', [
                                    'name' => 'test_name',
                                    'placeholder' => 'Test Name',
                                ])
                            </div>
                            <div class="col-5">
                                @include('components.backend.forms.input.input-type2', [
                                    'name' => 'spacifications',
                                    'placeholder' => 'Any Spacifications ?',
                                ])
                            </div>
                            <div class="col-2">
                                <button type="button"  class="btn btn-info">
                                    +
                                </button>
                                <button type="button"  class="btn btn-danger">
                                    -
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="body">
                        <h4>
                            Select Medicine
                        </h4>
                        <hr>
                        <div class="row justify-content-center mb-4">
                            <div class="col-10">
                                @include('components.backend.forms.input.input-type2', [
                                    'name' => 'search_medicine',
                                    'placeholder' => 'Search Medicine by Name / Type / Group',
                                ])
                            </div>
                        </div>
                        {{-- <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Name</th>
                                    <th>MG</th>
                                    <th>Group</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Paracetamol</td>
                                    <td>500</td>
                                    <td>Analgesic</td>
                                    <td>Tablet</td>
                                    <td>
                                        <button class="btn btn-info">
                                            Add
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table> --}}

                        <hr>
                        <h5 class="text-center">
                            Selected Medicine
                        </h5>
                        <hr>
                        <div id="medicineSeciton"></div>



                    </div>
                </div>

                <div class="card">
                    <div class="body">
                        <h4>
                            Next Visit
                        </h4>
                        <hr>
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'next_visit',
                            'placeholder' => 'Next Visit Time (eg. 7 days / 1 month)',
                            'required' => true,
                        ])

                    </div>
                </div>

                <div class="card">
                    <div class="body">
                        <h4>
                            Any Advice ?
                        </h4>
                        <hr>
                        <textarea name="advice" id="advice" rows="2" class="form-control" placeholder="Any Advice ?"></textarea>

                    </div>
                </div>

                <p class="text-right">
                    <button type="submit"  class="btn btn-info">
                        Submit
                    </button>
                </p>



            </form>
        </div>
    </div>


@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        //addination info add and remove
        $(document).on('click', '.p_infoAdd', function() {
            var html = `<div class="row  my-2">  <div class="col-5 ">
                                    @include('components.backend.forms.input.input-type2', [
                                        'name' => 'p_info[]',
                                        'placeholder' => 'Additional informarion (eg. Blood Pressure)',
                                        'required' => true,
                                        'value' => '',

                                    ])
                                </div>
                                <div class="col-5">
                                    @include('components.backend.forms.input.input-type2', [
                                        'name' => 'p_info_value[]',
                                        'placeholder' => 'Enter Value (eg. 120/80)',
                                        'required' => true,
                                        'value' => '',

                                    ])
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-info p_infoAdd">
                                        +
                                    </button>
                                    <button type="button" class="btn btn-danger p_infoRemove">
                                        -
                                    </button>
                                </div></div>`;

            $('#addination_info').append(html);
        });
        // p_remove remove
        $(document).on('click', '.p_infoRemove', function() {
            $(this).parent().parent().remove();
        });

        // symptoms_name add and remove
        $(document).on('click', '.chief_add', function() {
            var html = `<div class="row my-2">
                            <div class="col-10">
                                @include('components.backend.forms.input.input-type2', [
                                    'name' => 'symptoms_name',
                                    'placeholder' => 'Complaint',
                                    'class' => 'symptoms_name',
                                    'required' => true,
                                ])
                            </div>
                            <div class="col-2">
                                <button type="button"  class="btn btn-info chief_add">
                                    +
                                </button>
                                <button type="button"  class="btn btn-danger chief_remove">
                                    -
                                </button>
                            </div>
                        </div>`;

            $('#chief_complaints').append(html);
        });
        // chief_remove remove
        $(document).on('click', '.chief_remove', function() {
            $(this).parent().parent().remove();
        });


        // symptoms_name every id call for autocomplete suggestion
        $(document).on('input', '.symptoms_name', function() {
            $(this).autocomplete({
                source: function(request, response) {
                    var optionData = request.term;
                    $.ajax({
                        method: 'GET',
                        url: "{{ route('backend.siteConfig.symptom.index') }}",
                        data: {
                            'optionData': optionData
                        },
                        success: function(res) {
                            var resArray = $.map(res.data, function(obj) {
                                return {
                                    value_id: obj
                                        .id, //Show as label of input fieldname: obj.name,
                                    value: obj
                                        .name, //Show as label of input fieldname: obj.name,
                                    label: obj
                                        .name, //Show as label of input fieldname: obj.name,
                                }
                            })
                            response(resArray);
                        }
                    });
                },
                minLength: 1,
                select: function(event, ui) {
                    $(this).val(ui.item.value);
                    $(this).parents('.row').find('#symptoms_id').val(ui.item.value_id);
                    return false;
                }
            });
        })


        //search  patient
        $("#p_id").autocomplete({
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
                                mobile: obj.mobile, //Fillable in input field
                                value_id: obj.id, //Fillable in input field
                                name: obj.name, //Fillable in input field
                                value: obj
                                    .patientId, //Show as label of input fieldname: obj.name, mobile: obj.mobile
                                label: obj.name + '(' + obj.mobile +
                                    ')', //Show as label of input fieldname: obj.name, mobile: obj.mobile
                            }
                        })
                        response(resArray);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                // console.log(ui)
                // patient_Id data
                $('#p_id').val(ui.item.value);
                $('#p_mobile').val(ui.item.mobile);
                $('#p_name').val(ui.item.name);


            }
        });
        $("#p_name").autocomplete({
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
                                mobile: obj.mobile, //Fillable in input field
                                value_id: obj.id, //Fillable in input field
                                value: obj.name, //Fillable in input field
                                patientId: obj
                                    .patientId, //Show as label of input fieldname: obj.name, mobile: obj.mobile
                                label: obj.name + '(' + obj.mobile +
                                    ')', //Show as label of input fieldname: obj.name, mobile: obj.mobile
                            }
                        })
                        response(resArray);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                // console.log(ui)
                // patient_Id data
                $('#p_id').val(ui.item.patientId);
                $('#p_mobile').val(ui.item.mobile);
                $('#p_name').val(ui.item.name);


            }
        });

        $("#p_mobile").autocomplete({
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
                                name: obj.name, //Fillable in input field
                                value_id: obj.id, //Fillable in input field
                                value: obj.mobile, //Fillable in input field
                                patientId: obj
                                    .patientId, //Show as label of input fieldname: obj.name, mobile: obj.mobile
                                label: obj.name + '(' + obj.mobile +
                                    ')', //Show as label of input fieldname: obj.name, mobile: obj.mobile
                            }
                        })
                        response(resArray);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                // console.log(ui)
                // patient_Id data
                $('#p_id').val(ui.item.patientId);
                $('#p_mobile').val(ui.item.value);
                $('#p_name').val(ui.item.name);


            }
        });
        //end search  patient
        //


        $("#search_medicine").autocomplete({
            source: function(request, response) {
                var optionData = request.term;
                $.ajax({
                    method: 'GET',
                    url: "{{ route('backend.itemconfig.item.index') }}",
                    data: {
                        'optionData': optionData
                    },
                    success: function(res) {
                        // console.log(res)
                        var resArray = $.map(res.data, function(obj) {
                            return {
                                data: obj,
                                value: obj.name, //Fillable in input field
                                label: obj.name + '|' + obj.generic_name.name + '|' + obj.strength.name + '|' + obj.type.name //Show as label of input fieldname: obj.name, sku: obj.sku
                            }
                        })
                        response(resArray);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                let html = ` <section style="margin-top:1%">
                                <div class="d-flex justify-content-between">

                                    <input type="hidden" name="item_id[]" value="${ui.item.data.id}">

                                </div>

                            <table class="table table-bordered">

                                <tbody>
                                    <tr>
                                        <td colspan='2'><h6 class="text-info">${ui.item.data.name}</h6></td>
                                        <td colspan='2' class="text-right"> <button class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            @include('components.backend.forms.input.input-type2', [
                                                'name' => 'how_many_times[${ui.item.data.id}][]',
                                                'placeholder' => 'How many times a day ?',
                                                'required' => true,
                                            ])
                                        </td>
                                        <td>
                                            @include('components.backend.forms.input.input-type2', [
                                                'name' => 'how_many_quantity[${ui.item.data.id}][]',
                                                'placeholder' => 'Medicine Quantity (eg, 1 + 1 + 1)',
                                                'required' => true,
                                            ])
                                        </td>
                                        <td>
                                            @include('components.backend.forms.input.input-type2', [
                                                'name' => 'how_many_days[${ui.item.data.id}][]',
                                                'placeholder' => 'How many days ?',
                                                'required' => true,
                                            ])
                                        </td>
                                        <td>
                                            <p class="m-0">
                                                <input type="radio" value="before_meal" name="before_after_meal[${ui.item.data.id}][]" id="before_meal">
                                                <label for="before_meal">
                                                    Before Meal
                                                </label>
                                            </p>
                                            <p class="m-0">
                                                <input type="radio" value="between_meal" name="before_after_meal[${ui.item.data.id}][]" id="after_meal">
                                                <label for="between_meal">
                                                    Between Meal
                                                </label>
                                            </p>
                                            <p class="m-0">
                                                <input type="radio"value="after_meal" name="before_after_meal[${ui.item.data.id}][]"  id="after_meal">
                                                <label for="after_meal">
                                                    After Meal
                                                </label>
                                            </p>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan='4'> <textarea name="note[${ui.item.data.id}][]" id="note" rows="2" class="form-control"
                                            placeholder="Any Note ? (eg. Take medicine when you feel pain)"></textarea>
                                            </td>

                                    </section>
                                    </tr>
                                </tbody>
                            </table>

                           `;
                $('#medicineSeciton').after(html);

            }
        });




        // create a function to remove a row
        function removeRow(row) {
            $(row).closest('tr').remove();
            // approximateSellPrice();
        }
    </script>
@endpush
