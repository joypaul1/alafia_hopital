@extends('backend.layout.app')


@section('page-header')
    <i class="fa fa-list"></i> Lab Test Create
@stop
@section('content')

    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
        <style>
            .ui-autocomplete {
                position: absolute;
                cursor: default;
                z-index: 99999999999999 !important
            }

            .product-grid-container {
                display: grid;
                grid-template-columns: 1fr;
            }

            @media (min-width: 768px) {
                .product-grid-container {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 15px;
                }
            }
        </style>
    @endpush

    @include('backend._partials.modal_page_header', [
        'fa' => 'fa fa-plus-circle',
        'name' => 'Production list',
        'route' => route('backend.pathology.labTest.create'),
    ])

    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                {{ implode('', $errors->all('<div>:message</div>')) }}
            @endif
            <form action="{{ route('backend.pathology.labTest.store') }}" method="post">
                @csrf
                @method('POST')
                <div class="card">
                    <div class="body">


                        <div class="row">
                            <div class="col-md-3">
                                <input type="hidden" name="patient_id" id="patient_Id">
                                @include('components.backend.forms.input.input-type', [
                                    'name' => 'patient',
                                    'placeholder' => 'Enter Name Here ... ',
                                    'required' => true,
                                ])
                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('name'),
                                ])
                            </div>
                            <div class="col-md-3">
                                @include('components.backend.forms.input.input-type', [
                                    'name' => 'date',
                                    'value' => date('Y-m-d'),
                                    'placeholder' => 'Enter Name Here ... ',
                                    'required' => true,
                                    'type' => 'date',
                                ])
                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('name'),
                                ])
                            </div>
                            <div class="col-md-4">
                                @include('components.backend.forms.select2.option', [
                                    'name' => 'doctor_id',
                                    'label' => 'Referred By',
                                    'optionData' =>$doctors,
                                ])
                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('doctor_id'),
                                ])
                            </div>
                        </div>
                        <div class="body justify-content-center">
                            {{-- <h3 class="mb-1 text-center">Test Items</h3>
                            <hr> --}}
                            <div class="row justify-content-center">
                                <div class="col-md-6 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-search-plus"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    @include('components.backend.forms.input.input-type2', [
                                        'name' => 'testItem',
                                        'placeholder' => 'Enter Test Name Here ...',
                                    ])


                                </div>
                            </div>

                            <div class="table-responsive">
                                <table ellspacing='0' class="table table-bordered text-center testTable">
                                    <thead>
                                        <tr>
                                            <th> Test Name </th>
                                            <th> Price </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="labTestAppend"></tr>

                                    </tbody>
                                </table>
                                <div class=" form-inline d-flex justify-content-end">
                                    <div class="form-group">
                                        <label> Sub-Total:</label>
                                        <input type="text" readonly name="testSubTotal" class="form-control text-right"
                                            id="testSubTotal">
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table ellspacing='0' class="table table-bordered text-center testTubeTable">
                                    <thead>
                                        <tr>
                                            <th> Tube Name </th>
                                            <th> Price </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="testTubeAppend"></tr>

                                    </tbody>
                                </table>
                                <div class=" form-inline d-flex justify-content-end">
                                    <div class="form-group">
                                        <label> Sub-Total:</label>
                                        <input type="text" readonly name="tubeSubTotal" class="form-control text-right"
                                            id="tubeSubTotal">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="card text-right">
                    <div class="body">
                        <strong>Total : <span id="totalPrice">0.00</span>Tk </strong>
                    </div>
                </div>
                <div class="d-block text-right mb-5">
                    <button class="btn btn-lg btn-info ">Save</button>
                </div>
            </form>
        </div>
    </div>


@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $("#patient").autocomplete({
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
                                label: 'Name:' + obj.name +' mobile:' + obj.mobile, //Show as label of input fieldname: obj.name, mobile: obj.mobile
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
        //testItem autocomplete
        $("#testItem").autocomplete({
            source: function(request, response) {
                var optionData = request.term;
                $.ajax({
                    method: 'GET',
                    url: "{{ route('backend.siteConfig.labTest.index') }}",
                    data: {
                        'optionData': optionData
                    },
                    success: function(res) {
                        var resArray = $.map(res.data, function(obj) {
                            return {
                                tube: obj.tube, //Fillable in input field
                                value: obj.name, //Fillable in input field
                                category: obj.category, //Fillable in input field
                                price: obj.price, //Fillable in input field
                                label: obj.name,
                                value_id: obj.id
                            }
                        })
                        response(resArray);
                    }
                });
            },

            select: function(event, ui) {
                // labTest data append in table
                let row = `<tr>
                            <td>
                                <input type="hidden" class="labTest_id"  name="labTest_id[]" value="${ui.item.value_id}">
                                <input type="hidden" class="labTestCatName"  value="${ui.item.category}">
                                ${ui.item.label}
                            </td>
                            <td>
                                <input type="text" name="test_price[]"
                                value="${ui.item.price}" class="form-control test_price text-right"readonly>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm removeLabTest"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>`;
                $('#labTestAppend').last().after(row);


                //get all labTestCatName value by class name labTestCatName
                let testTube_id = $('.testTube_id').map(function() {
                    return $(this).val();
                }).get();
                let labTestCatName = $('.labTestCatName').map(function() {
                    return $(this).val();
                }).get();
                if ($.inArray((ui.item.tube.id).toString(), testTube_id) != -1 && $.inArray((ui.item.category).toString(), labTestCatName) != -1) {
                } else {
                    // testTube data append in table
                    let tube = `<tr>
                            <td>
                                <input type="hidden" name="testTube_id[]" class="testTube_id" value="${ui.item.tube.id}">
                                ${ui.item.tube.name}
                            </td>
                            <td>
                                <input type="text" name="testTube_price[]"
                                value="${ui.item.tube.price}" class="form-control testTube_price text-right"
                                readonly>
                            </td>
                        </tr>`;
                    $('#testTubeAppend').last().after(tube);
                }

                approximatePrice();
            }
        });


        //removeLabTest
        $(document).on('click', '.removeLabTest', function() {
            // console.log($(this).parent('td').parent('tr').find('td >.labTest_id').val());
            removeRow(this);
            // remove all testTubeTable table tbody tr ignore tr id testTubeAppend
            // console.log();
            $('.testTubeTable tbody tr').not('#testTubeAppend').remove()
            // get testTable all tbody tr td labTest_id value
            $('.labTest_id').map(function() {
                //ajax request
                $.ajax({
                    method: 'GET',
                    url: "{{ route('backend.siteConfig.labTest.index') }}",
                    data: {
                        'labTest_id': $(this).val()
                    },
                    success: function(res) {

                        let labTestCatName = $('.labTestCatName').map(function() {return $(this).val()}).get();
                        let testTube_id = $('.testTube_id').map(function() {return $(this).val()}).get();
                        // console.log(res);
                        if ($.inArray((res.data.tube.id).toString(), testTube_id) != -1 && $.inArray((res.data.category).toString(), labTestCatName) != -1) {
                        } else {
                            // testTube data append in table
                            let tube = `<tr>
                                    <td>
                                        <input type="hidden" name="testTube_id[]" class="testTube_id" value="${res.data.tube.id}">
                                        ${res.data.tube.name}
                                    </td>
                                    <td>
                                        <input type="text" name="testTube_price[]"
                                        value="${res.data.tube.price}" class="form-control testTube_price text-right"
                                        readonly>
                                    </td>
                                </tr>`;
                            $('#testTubeAppend').last().after(tube);
                        }
                    }
                });
            }).get();
            approximatePrice();

        });

        // create a function to remove a row
        function removeRow(row) {
            $(row).closest('tr').remove();

        }


        approximatePrice = function() {
            var test_price = tube_price = 0;
            $('.test_price').each(function() {
                test_price += Number($(this).val().replace(/[^0-9\.]+/g, ""));
            });
            $('.testTube_price').each(function() {
                tube_price += Number($(this).val().replace(/[^0-9\.]+/g, ""));
            });
            $('#testSubTotal').val(test_price.toFixed(2));
            $('#tubeSubTotal').val(tube_price.toFixed(2));

            var total = test_price + tube_price;
            $('#totalPrice').text(total.toFixed(2));
        }
    </script>
@endpush
