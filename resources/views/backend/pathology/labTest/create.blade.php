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
        'name' => 'LabTest Invoice list',
        'route' => route('backend.pathology.labTest.create'),
    ])

    <div class="row">
        <div class="col-12">
            {{-- @if ($errors->any())
                {{ implode('', $errors->all('<div>:message</div>')) }}
            @endif --}}
            <form action="{{ route('backend.pathology.labTest.store') }}" method="post">
                @csrf
                @method('POST')
                <div class="card">
                    <div class="body">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" name="patient_id" id="patient_Id">
                                {{-- @include('components.backend.forms.input.input-type', [
                                    'name' => 'patient',
                                    'placeholder' => 'Enter Name Here ... ',
                                    'required' => true,
                                ]) --}}
                                <label class="col-form-label" for="date">
                                    Patient
                                    <span class="text-danger">* </span>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input type="text" name="patient" id="patient" class="form-control"
                                        placeholder="Patient Name/Id/Mobile num.." autocomplete="off" required="">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="create_patient"
                                            data-href="{{ route('backend.patient.create') }}">
                                            <i class="fa fa-plus" style="cursor: pointer;"></i>
                                        </span>
                                    </div>
                                </div>

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
                                    'optionData' => $doctors,
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
                                {{-- <div class="col-md-6 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-search-plus"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    @include('components.backend.forms.input.input-type2', [
                                        'name' => 'testItem',
                                        'placeholder' => 'Enter Test Name Here ...',
                                    ])
                                </div> --}}
                                <div class="col-md-6 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-search-plus"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <input type="text" name="testItem" id="testItem"
                                        class="form-control ui-autocomplete-input" placeholder="Enter Test Name Here ..."
                                        autocomplete="off">
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table ellspacing='0' class="table table-bordered text-center testTable">
                                    <thead>
                                        <tr>
                                            <th> Test Name </th>
                                            <th> Price </th>
                                            <th> Discount Type </th>
                                            <th> Discount </th>
                                            <th> Discount Amount </th>
                                            <th> SubTotal </th>
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
                    <div class="body row">
                        <div class="col-4">
                            @include('components.backend.forms.input.input-type', [
                                'name' => 'payable_amount',
                                'readonly' => 'true',
                                'value' => 0.0,
                            ])
                        </div>

                        <div class="col-4">
                            @include('components.backend.forms.input.input-type', [
                                'name' => 'paid_amount',
                                'value' => 0.0,
                            ])
                        </div>
                        <div class="col-4">
                            @include('components.backend.forms.input.input-type', [
                                'name' => 'due_amount',
                                'readonly' => true,
                                'value' => 0.0,
                            ])
                        </div>
                        {{-- <strong>Total : <span id="totalPrice">0.00</span>Tk </strong> --}}
                    </div>
                </div>
                <div class="d-block text-right mb-5">
                    <button class="btn btn-lg btn-info">Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Patient modal --}}
    <div class="modal fade" id="patient_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role=" document">

        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
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

        //get date of birth form today's age
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




        // $('.appointment_modal #appointment_add_form .modal-body .col-4 #doctor_fees')
        $(document).on('click', '#create_patient', function(e) {
            e.preventDefault();
            var modal = "#patient_modal";
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
                        $('#patient').val(response.data.name);
                        $('#patient_Id').val(response.data.id);
                        $('#patient_modal').modal('hide');
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });


        //patient autocomplete
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
                                value: null, //Fillable in input field
                                category: obj.category, //Fillable in input field
                                price: obj.price, //Fillable in input field
                                label: obj.name,
                                value_id: obj.id,
                                needle: obj.needle,
                                glucose: obj.glucose,
                            }
                        })
                        response(resArray);
                    }
                });
            },

            select: function(event, ui) {
                event.preventDefault();
                $("#testItem").val(null);
                // labTest data append in table also added table row discount_type dropdown & discount & discount_amount with html event attribute
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
                                    <select name="discount_type[]" class="form-control discount_type" onChange=>"discount_type()">
                                        <option value="${null}" hidden><-- Discount --> </option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percentage" selected >Percentage</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="discount[]" class="form-control discount text-right"  value="0">
                                </td>
                                <td>
                                    <input type="text" name="discount_amount[]" class="form-control discount_amount text-right" value="0" readonly>
                                </td>

                                <td>
                                    <input type="text" name="subtotal[]"
                                    value="${ui.item.price}" class="form-control subtotal text-right"readonly>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm removeLabTest"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>`;

                $('#labTestAppend').last().after(row);

                if (ui.item.tube) {
                    //get all labTestCatName value by class name labTestCatName
                    let testTube_id = $('.testTube_id').map(function() {
                        return $(this).val();
                    }).get();
                    let labTestCatName = $('.labTestCatName').map(function() {
                        return $(this).val();
                    }).get();

                    if ($.inArray((ui.item.tube.id).toString(), testTube_id) != -1 && $.inArray((ui.item
                                .category)
                            .toString(), labTestCatName) != -1) {} else {
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
                }

                // console.log(ui.item.needle);


                //append needle data in testTubeAppend row

                if (ui.item.needle > 0) {

                    let needle_id = $('.needle_id').map(function() {
                        return $(this).val();
                    }).get();
                    let needle_for = $('.needle_for').map(function() {
                        return $(this).val();
                    }).get();

                    if ((ui.item.label).toString() == "Fasting Blood Sugar (FBS)" || (ui.item.label)
                        .toString() == "Random Blood Sugar (RBS)") {
                        let needle = `<tr>
                                    <td>
                                        <input type="hidden" name="needle_id[]"  class="needle_id" value="needle">
                                        <input type="hidden" class="needle_for" value="${ui.item.label}">
                                        Needle
                                    </td>
                                    <td>
                                        <input type="text" name="needle_price[]"
                                        value="${20}" class="form-control testTube_price text-right"
                                        readonly>
                                    </td>
                                </tr>`;
                        let classLength = $('.needle_id').length;
                        if (classLength == 1) {
                            $('#testTubeAppend').last().after(needle);

                        } else if (classLength == 0) {
                            $('#testTubeAppend').last().after(needle);
                            $('#testTubeAppend').last().after(needle);
                        }
                    } else {
                        //first check needle not exist
                        if ($.inArray('needle', needle_id) != -1) {
                            console.log('exist');
                        } else {
                            let needle = `<tr>
                                <td>
                                    <input type="hidden" name="needle_id[]"  class="needle_id" value="needle">
                                    <input type="hidden" class="needle_for" value="${ui.item.label}">
                                    Needle
                                </td>
                                <td>
                                    <input type="text" name="needle_price[]"
                                    value="${20}" class="form-control testTube_price text-right"
                                    readonly>
                                </td>
                            </tr>`;
                            $('#testTubeAppend').last().after(needle);
                        }
                    }

                }
                approximatePrice();
            }
        });


        //removeLabTest
        $(document).on('click', '.removeLabTest', function() {
            removeRow(this);
            // remove all testTubeTable table tbody tr ignore tr id testTubeAppend
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
                        let labTestCatName = $('.labTestCatName').map(function() {
                            return $(this).val()
                        }).get();
                        let testTube_id = $('.testTube_id').map(function() {
                            return $(this).val()
                        }).get();
                        // console.log(res);
                        if ($.inArray((res.data.tube.id).toString(), testTube_id) != -1 && $
                            .inArray((res.data.category).toString(), labTestCatName) != -1
                        ) {
                            console.log('exist');
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

        //discount_type change event
        $(document).on('change', '.discount_type', function() {
            let discountPrice = 0;
            let discount_type = $(this).val();
            let discount = $(this).parent('td').next('td').find('.discount').val();
            let test_price = $(this).parent('td').prev('td').find('.test_price').val();
            let discount_amount = $(this).parent('td').next('td').next('td').find('.discount_amount');
            let subtotal = $(this).parent('td').next('td').next('td').next('td').find('.subtotal');
            if (discount_type == 'fixed') {
                discountPrice = Number(discount)
                discount_amount.val(discountPrice.toFixed(2));
            } else if (discount_type == 'percentage') {
                discountPrice = (Number(test_price) * Number(discount)) / 100
                discount_amount.val(discountPrice.toFixed(2));
            } else {
                discount_amount.val(0);
            }
            subtotal.val((Number(test_price) - Number(discountPrice)).toFixed(2));

            approximatePrice();
        });

        //discount change event
        $(document).on('input', '.discount', function() {
            let discountPrice = 0;
            let discount_type = $(this).parent('td').prev('td').find('.discount_type').val();
            let discount_amount = $(this).parent('td').next('td').find('.discount_amount');
            if(Number($(this).val()||0) > 20 && discount_type == 'percentage'){
                $(this).val(20);
                $(this).css('border','1px solid red');
                let $message ="Not More Than 20 % Discount! &#128528; ";
                    let $context = 'error';
                    let $positionClass= 'toast-top-right';
                    toastr.remove();
                    toastr[$context]($message, '', {
                        positionClass: $positionClass
                    });

                $(this).after(div);
            }
            console.log($(this).val(), 'discount_amount',Number($(this).val()||0) > 20);

            let discount = $(this).val();
            let test_price = $(this).parent('td').prev('td').prev('td').find('.test_price').val();

            let subtotal = $(this).parent('td').next('td').next('td').find('.subtotal');

            if (discount_type == 'fixed') {
                discountPrice = Number(discount)
                discount_amount.val(discountPrice.toFixed(2));
            } else if (discount_type == 'percentage') {
                discountPrice = (Number(test_price) * Number(discount)) / 100
                discount_amount.val(discountPrice.toFixed(2));
            } else {
                discount_amount.val(0);
            }
            subtotal.val((Number(test_price) - Number(discountPrice)).toFixed(2));
            approximatePrice();
        });



        // create a function to remove a row
        function removeRow(row) {
            $(row).closest('tr').remove();

        }

        approximatePrice = function() {
            var subtotal = tube_price = 0;
            $('.subtotal').each(function() {
                subtotal += Number($(this).val().replace(/[^0-9\.]+/g, ""));
            });
            $('.testTube_price').each(function() {
                tube_price += Number($(this).val().replace(/[^0-9\.]+/g, ""));
            });
            $('#testSubTotal').val(subtotal.toFixed(2));
            $('#tubeSubTotal').val(tube_price.toFixed(2));

            var total = subtotal + tube_price;
            $('#totalPrice').text(total.toFixed(2));
            $('#payable_amount').val(total.toFixed(2));
            $('#due_amount').val(total.toFixed(2));
        }

        //paid amount change event
        $(document).on('input', '#paid_amount', function() {
            let paid_amount = $(this).val();
            let payable_amount = $('#payable_amount').val();
            let due_amount = $('#due_amount');
            if (paid_amount > payable_amount) {
                due_amount.val(0);
            } else {
                due_amount.val((Number(payable_amount) - Number(paid_amount)).toFixed(2));
            }
        });
    </script>
@endpush
