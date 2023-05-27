@extends('backend.layout.app')
@section('page-header')
    <i class="fa fa-list"></i> Lab Test Create
@stop
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">

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
@section('content')
    @include('backend._partials.modal_page_header', [
        'fa' => 'fa fa-plus-circle',
        'name' => 'LabTest Invoice list',
        'route' => route('backend.pathology.labTest.create'),
    ])

    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <p class="text-danger">{{ implode('', $errors->all('<div>:message</div>')) }}</p>
            @endif
            <form action="{{ route('backend.pathology.labTest.store') }}" method="post">
                @csrf
                @method('POST')
                <div class="card">
                    <div class="body">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <input type="hidden" name="patient_id" id="patient_Id">

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
                            <div class="col-md-2">
                                @include('components.backend.forms.input.input-type', [
                                    'name' => 'date',
                                    'value' => date('Y-m-d'),
                                    'placeholder' => 'Enter Name Here ... ',
                                    'required' => true,
                                ])
                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('name'),
                                ])
                            </div>

                            <div class="col-md-4">
                                <input type="hidden" name="doctor_id" id="doctor_Id">

                                <label class="col-form-label" for="date">
                                    Doctor
                                    <span class="text-danger">* </span>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input type="text" name="doctor" id="doctor" class="form-control"
                                        placeholder="Doctor Name/Email/Mobile num.." autocomplete="off" required="">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="create_doctor">
                                            <i class="fa fa-plus" style="cursor: pointer;"></i>
                                        </span>
                                    </div>
                                </div>

                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('name'),
                                ])
                            </div>
                        </div>
                        <div class="body ">
                            {{-- <h3 class="mb-1 text-center">Test Items</h3>
                            <hr> --}}
                            <div class="row justify-content-center">

                                <div class="col-md-6 input-group mb-3">
                                    {{-- <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-search-plus"
                                                aria-hidden="true"></i></span>
                                    </div> --}}
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
                                'number' => true,
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

    {{-- Doctor modal --}}
    <div class="modal fade" id="doctor_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role=" document">
            <div class="modal-content">
                <form class="needs-validation" id="doctor_add_form" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h4 class="title" id="">New Doctor</h4>
                    </div>

                    <div class="modal-body">
                        <div class="form-validation">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">

                                        <label class="col-form-label" for="name">

                                            Name
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="first_name" class="form-control" id="name"
                                            placeholder="Enter Name" value="" autocomplete="off" required="">
                                    </div>

                                </div>

                                <div class="col-4">
                                    <div class="form-group">

                                        <label class="col-form-label" for="mobile">

                                            Mobile
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="mobile" class="form-control" id="mobile"
                                            min="0" step="0.01" title="amount" pattern="^\d+(?:\.\d{1,2})?$"
                                            onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                                            placeholder="Enter Mobile" value="" autocomplete="off" required="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">

                                        <label class="col-form-label" for="email">

                                            Email
                                        </label>

                                        <input type="text" name="email" class="form-control" id="email"
                                            placeholder="Enter Email" value="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">

                                        <label class="col-form-label" for="emargency_contact">

                                            Emargency contact
                                        </label>

                                        <input type="text" name="emargency_contact" class="form-control"
                                            id="emargency_contact" placeholder="Enter Emargency Contact" value=""
                                            autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label class="col-form-label for=" gender"="">
                                        Gender
                                    </label>




                                    <select class="form-control show-tick ms select2" id="gender" name="gender">
                                        <option value="">- select gender -</option>
                                        <option value="male">
                                            male
                                        </option>
                                        <option value="female">
                                            female
                                        </option>
                                        <option value="others">
                                            others
                                        </option>
                                    </select>

                                </div>





                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                        <button type="submit" class="btn btn-primary">SAVE</button>
                    </div>
                </form>
            </div>

        </div>
    </div>



@endsection

@push('js')
    @include('backend.pathology.labTest.labTestJs')
    <script src="{{ asset('assets/backend/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('#date').datepicker({
            format: 'dd-mm-yyyy',
            startDate: '-5y'

        });
        // date_of_birth
        $(document).on('change', '#date_of_birth', function(e) {
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

        //get patient info
        $(document).on('click', '#create_doctor', function(e) {
            e.preventDefault();
            var modal = "#doctor_modal";
            $(modal).modal('show');
        });
        //get patient info
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

        //store doctor info
        $(document).on('submit', '#doctor_add_form', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = "{{ route('backend.ajaxStore.doctor') }}";
            var method = "POST";
            var data = {
                first_name: form.find('#name').val(),
                mobile: form.find('#mobile').val(),
                email: form.find('#email').val(),
            };
            $.ajax({
                url: url,
                type: method,
                data: data,
                success: function(res) {
                    console.log(res.data.name)
                    if (res.status_code == 200) {
                        $('#doctor').val(res.data.first_name);
                        $('#doctor_Id').val(res.data.id);
                        $("#doctor_modal").modal('hide');
                        let $message = res.success;
                        let $context = 'success';
                        let $positionClass = 'toast-top-right';
                        toastr.remove();
                        toastr[$context]($message, '', {
                            positionClass: $positionClass
                        });
                    } else {
                        let $message = res.errors ?? 'Something went wrong!';
                        let $context = 'error';
                        let $positionClass = 'toast-top-right';
                        toastr.remove();
                        toastr[$context]($message, '', {
                            positionClass: $positionClass
                        });
                    }
                },
                error: function(response) {
                    var errors = response;
                    console.log(errors.responseJSON.errors, 'errors');
                    var myObject = errors.responseJSON.errors;
                    for (var key in myObject) {
                        if (myObject.hasOwnProperty(key)) {
                            console.log(key + "/" + myObject[key]);
                            $("form#doctor_add_form input[name='" + key + "']").after(
                                "<div class='text-danger'><strong>" + ' ' + " </strong></div>");
                            $("form#doctor_add_form input[name='" + key + "']").after(
                                "<div class='text-danger'><strong>" + myObject[key] +
                                " </strong></div>");
                            let $message = myObject[key];
                            let $context = 'error';
                            let $positionClass = 'toast-top-right';
                            toastr.remove();
                            toastr[$context]($message, '', {
                                positionClass: $positionClass
                            });
                        }

                    }
                }
            });
        });
        //store patient info
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


        //doctor autocomplete
        $("#doctor").autocomplete({
            source: function(request, response) {
                var optionData = request.term;
                $.ajax({
                    method: 'GET',
                    url: "{{ route('backend.doctor.index') }}",
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
                $('#doctor_Id').val(ui.item.value_id);


            }
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

        //discount_type change event
        $(document).on('change', '.discount_type', function() {
            let discountPrice = 0;
            let discount_type = $(this).val();
            let discount = $(this).parent('td').next('td').find('.discount').val() || 0;
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
            if (Number($(this).val() || 0) > 25 && discount_type == 'percentage') {
                $(this).val(25);
                $(this).css('border', '1px solid red');
                let $message = "Not More Than 25% Discount! &#128528; ";
                let $context = 'error';
                let $positionClass = 'toast-top-right';
                toastr.remove();
                toastr[$context]($message, '', {
                    positionClass: $positionClass
                });
                $(this).after(div);
            }

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
