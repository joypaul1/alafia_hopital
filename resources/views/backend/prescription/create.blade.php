@extends('backend.layout.app')


@section('page-header')
    <i class="fa fa-plus-circle"></i> Prescription Create
@stop
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
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
                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.input.input-type2', [
                                    'name' => 'p_name',
                                    'placeholder' => 'Seach By Patient Name(Mr Jack)',
                                    'required' => true,
                                ])
                            </div>
                            <div class="col-4">
                                @include('components.backend.forms.input.input-type2', [
                                    'name' => 'p_mobile',
                                    'number' => true,
                                    'placeholder' => 'Seach By Patient Mobile(01******)',
                                    'required' => true,
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
                                        ])
                                    </div>
                                    <div class="col-5">
                                        @include('components.backend.forms.input.input-type2', [
                                            'name' => 'p_info_value[]',
                                            'placeholder' => 'Enter Value (eg. 120/80)',
                                            'required' => true,
                                        ])
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-info p_infoAdd">
                                            +
                                        </button>
                                        <button class="btn btn-danger p_infoRemove">
                                            -
                                        </button>
                                    </div>
                                </div>
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
                                    'required' => true,
                                ])
                            </div>
                            <div class="col-2">
                                <button class="btn btn-info">
                                    +
                                </button>
                                <button class="btn btn-danger">
                                    -
                                </button>
                            </div>
                        </div>

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
                                    'required' => true,
                                ])
                            </div>
                            <div class="col-5">
                                @include('components.backend.forms.input.input-type2', [
                                    'name' => 'spacifications',
                                    'placeholder' => 'Any Spacifications ?',
                                    'required' => true,
                                ])
                            </div>
                            <div class="col-2">
                                <button class="btn btn-info">
                                    +
                                </button>
                                <button class="btn btn-danger">
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
                                    'required' => true,
                                ])
                            </div>
                        </div>
                        <table class="table table-bordered text-center">
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
                        </table>

                        <hr>

                        <h5 class="text-center">
                            Selected Medicine
                        </h5>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h6 class="text-info">
                                <strong>
                                    1.
                                </strong>
                                Paracetamol 500mg
                            </h6>
                            <button class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>

                        <table class="table table-bordered my-3">
                            <tbody>
                                <tr>
                                    <td>
                                        @include('components.backend.forms.input.input-type2', [
                                            'name' => 'take_time',
                                            'placeholder' => 'How many times a day ?',
                                            'required' => true,
                                        ])
                                    </td>
                                    <td>
                                        @include('components.backend.forms.input.input-type2', [
                                            'name' => 'medicine_quantity',
                                            'placeholder' => 'Medicine Quantity (eg, 1 + 1 + 1)',
                                            'required' => true,
                                        ])
                                    </td>
                                    <td>
                                        @include('components.backend.forms.input.input-type2', [
                                            'name' => 'take_time',
                                            'placeholder' => 'How many days ?',
                                            'required' => true,
                                        ])
                                    </td>
                                    <td>
                                        <p class="m-0">
                                            <input type="radio" name="eat_time" id="before_meal">
                                            <label for="before_meal">
                                                Before Meal
                                            </label>
                                        </p>
                                        <p class="m-0">
                                            <input type="radio" name="eat_time" id="after_meal">
                                            <label for="after_meal">
                                                After Meal
                                            </label>
                                        </p>

                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <textarea name="note" id="note" rows="2" class="form-control"
                            placeholder="Any Note ? (eg. Take medicine when you feel pain)"></textarea>

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
                    <button class="btn btn-info">
                        Submit
                    </button>
                </p>



            </form>
        </div>
    </div>


@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>file:///home/icicle/Downloads/BiochemistryReport.html

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
                                value: obj.patientId, //Show as label of input fieldname: obj.name, mobile: obj.mobile
                                label: obj.name + '(' + obj.mobile+')', //Show as label of input fieldname: obj.name, mobile: obj.mobile
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
                                patientId: obj.patientId, //Show as label of input fieldname: obj.name, mobile: obj.mobile
                                label: obj.name + '(' + obj.mobile+')', //Show as label of input fieldname: obj.name, mobile: obj.mobile
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
                                patientId: obj.patientId, //Show as label of input fieldname: obj.name, mobile: obj.mobile
                                label: obj.name + '(' + obj.mobile+')', //Show as label of input fieldname: obj.name, mobile: obj.mobile
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


        $("#product_name").autocomplete({
            source: function(request, response) {
                var optionData = request.term;
                $.ajax({
                    method: 'GET',
                    url: "{{ route('backend.itemconfig.item.index') }}",
                    data: {
                        'optionData': optionData
                    },
                    success: function(res) {
                        var resArray = $.map(res.data, function(obj) {
                            console.log(obj.sell_price);
                            return {
                                sell_price: obj.sell_price, //Fillable in input field
                                unit: obj.unit, //Fillable in input field
                                value: obj.name, //Fillable in input field
                                value_id: obj.id, //Fillable in input field
                                label: 'Name:' + obj.name + ' sku:' + obj
                                .sku, //Show as label of input fieldname: obj.name, sku: obj.sku
                            }
                        })
                        response(resArray);
                    }
                });
            },
            minLength: 3,
            select: function(event, ui) {
                let html = '<tr>'
                html += '<td> <input type="text" readonly  class="form-control text-center" value="' + ui.item
                    .value + '"></td>'
                html += ' <input type="hidden"  name="pItem_id[]" class="form-control text-cente" value="' + ui
                    .item.value_id + '">'
                html +=
                    '<td> <input type="text" readonly  name="unit[]" class="form-control text-center" value="' +
                    ui.item.unit.name + '"></td>'
                html +=
                    '<td> <input type="text"   name="p_qty[]" class="form-control text-center p_qty" value="' +
                    1 + '"></td>'
                html +=
                    '<td> <input type="text" readonly  name="pu_price[]" class="form-control text-center pu_price" value="' +
                    parseFloat(ui.item.sell_price).toFixed(2) + '"></td>'
                html +=
                    '<td> <input type="text" readonly  name="p_total_price[]" class="form-control text-center p_total_price" value="' +
                    parseFloat(ui.item.sell_price).toFixed(2) + '"></td>'
                html += '<td> <button class="btn btn-danger" onclick="removeRow(this)">-</button></td>'
                html += '</tr>'
                $('#productionItem').after(html);
                approximateSellPrice();
                approximateProfit();
            }
        });

        $("#material_name").autocomplete({
            source: function(request, response) {
                var optionData = request.term;
                $.ajax({
                    method: 'GET',
                    url: "{{ route('backend.itemconfig.item.index') }}",
                    data: {
                        'optionData': optionData
                    },
                    success: function(res) {
                        var resArray = $.map(res.data, function(obj) {
                            return {
                                sell_price: obj.sell_price, //Fillable in input field
                                unit: obj.unit, //Fillable in input field
                                value: obj.name, //Fillable in input field
                                value_id: obj.id, //Fillable in input field
                                label: 'Name:' + obj.name + ' sku:' + obj
                                .sku, //Show as label of input fieldname: obj.name, sku: obj.sku
                            }
                        })
                        response(resArray);
                    }
                });
            },
            minLength: 3,
            select: function(event, ui) {
                let html = '<tr>'
                html += '<td> <input type="text" readonly  class="form-control text-center" value="' + ui.item
                    .value + '"></td>'
                html += ' <input type="hidden"  name="mItem_id[]" class="form-control text-cente" value="' + ui
                    .item.value_id + '">'
                html +=
                    '<td> <input type="text" readonly  name="unit[]" class="form-control text-center" value="' +
                    ui.item.unit.name + '"></td>'
                html +=
                    '<td> <input type="text"   name="m_qty[]" class="form-control text-center m_qty" value="' +
                    1 + '"></td>'
                html +=
                    '<td> <input type="text" readonly  name="mu_price[]" class="form-control text-center mu_price" value="' +
                    parseFloat(ui.item.sell_price).toFixed(2) + '"></td>'
                html +=
                    '<td> <input type="text" readonly  name="m_total_price[]" class="form-control text-center m_total_price" value="' +
                    parseFloat(ui.item.sell_price).toFixed(2) + '"></td>'
                html += '<td> <button class="btn btn-danger" onclick="removeMRow(this)">-</button></td>'
                html += '</tr>'
                $('#materialsItem').after(html);
                approximateCost();
                approximateProfit();
            }
        });


        // create a function to remove a row
        function removeRow(row) {
            $(row).closest('tr').remove();
            approximateSellPrice();
        }

        function removeMRow(row) {
            $(row).closest('tr').remove();
            approximateCost();
        }

        $(document).on('keyup', '.p_qty', function() {
            var p_qty = $(this).val();
            var pu_price = $(this).closest('tr').find('.pu_price').val();
            pu_price = Number(pu_price.replace(/[^0-9\.]+/g, ""));
            var p_total_price = p_qty * pu_price;
            $(this).closest('tr').find('.p_total_price').val(p_total_price);
            approximateSellPrice();
            approximateProfit();
        });
        $(document).on('keyup', '.m_qty', function() {
            var m_qty = $(this).val();
            var mu_price = $(this).closest('tr').find('.mu_price').val();
            mu_price = Number(mu_price.replace(/[^0-9\.]+/g, ""));
            var p_total_price = m_qty * mu_price;
            $(this).closest('tr').find('.m_total_price').val(p_total_price);
            approximateSellPrice();
            approximateProfit();
        });


        approximateSellPrice = function() {
            var total = 0;
            $('.p_total_price').each(function() {
                total += Number($(this).val().replace(/[^0-9\.]+/g, ""));
            });
            $('#approximateSell').val(total.toFixed(2));

            return total;
        }
        approximateCost = function() {
            var total = 0;
            $('.m_total_price').each(function() {
                total += Number($(this).val().replace(/[^0-9\.]+/g, ""));
            });
            $('#approximateCost').val(total.toFixed(2));
            return total;
        }

        // Something for test

        function approximateProfit() {
            $('#approximateProfit').text(approximateSellPrice() - approximateCost());
            console.log(approximateSellPrice() - approximateCost(), 'profile');
        }
    </script>
@endpush
