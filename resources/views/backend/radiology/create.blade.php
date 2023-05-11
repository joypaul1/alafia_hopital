@extends('backend.layout.app')
@section('page-header')
    <i class="fa fa-list"></i> Radiology Invoice Create
@stop
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
@section('content')
    @include('backend._partials.page_header', [
        'fa' => 'fa fa-plus-circle',
        'name' => ' Radiology Invoice list',
        'route' => route('backend.radiologyServiceInvoice.index'),
    ])

    <div class="row">
        <div class="col-12">
            {{-- @if ($errors->any())
                {{ implode('', $errors->all('<div>:message</div>')) }}
            @endif --}}
            <form action="{{ route('backend.radiologyServiceInvoice.store') }}" method="post">
                @csrf
                @method('POST')
                <div class="card">
                    <div class="body">
                        <div class="row">
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
                            <div class="col-md-3">
                                @include('components.backend.forms.input.input-type', [
                                    'name' => 'date',
                                    'value' => date('Y-m-d'),
                                    'placeholder' => 'Enter Name Here ... ',
                                    'required' => true,
                                    'inType' => 'date',
                                ])
                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('name'),
                                ])
                            </div>
                            <div class="col-md-3 ">
                                @include('components.backend.forms.select2.option', [
                                    'name' => 'doctor_id',
                                    'label' => 'Referred By',
                                    'optionData' => $doctors,
                                ])
                                {{-- <div class="input-group-prepend">
                                    <span class="input-group-text" id="create_patient"
                                        data-href="{{ route('backend.patient.create') }}">
                                        <i class="fa fa-plus" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('doctor_id'),
                                ]) --}}
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
                                    <input type="text" name="testItem" id="testItem"
                                        class="form-control ui-autocomplete-input" placeholder="Enter Service Name Here ..."
                                        autocomplete="off">
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table ellspacing='0' class="table table-bordered text-center testTable">
                                    <thead>
                                        <tr>
                                            <th> Test Name </th>
                                            <th> Price </th>
                                            {{-- <th> Discount Type </th>
                                            <th> Discount </th>
                                            <th> Discount Amount </th> --}}
                                            {{-- <th> SubTotal </th> --}}
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


                        </div>
                    </div>
                </div>


                {{-- <div class="card text-right">
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

                    </div>
                </div> --}}
                <div class="card border-top">
                    <div class="card-body">
                        <h5>
                            Add Payment
                        </h5>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'discount_type', 'optionData'=> $dis_status ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('discount_type')])
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'discount','number' => true, 'placeholder' => 'Enter Discount Amount'])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('discount')])
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'discount_amount','number' => true, 'readonly' => true, 'placeholder' => 'Discount Amount'])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('discount_amount')])
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',['label'=> 'Payable Amount' ,'name' => 'payable_amount','placeholder' => 'Payable amount here...','readonly'=> true  ])
                                    @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('payment_amount')])
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',['label'=> 'Paid Amount' ,'name' => 'paid_amount','placeholder' => 'Enter amount here...', ])
                                    @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('paid_amount')])
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="col-form-label">
                                    Payment Method:
                                </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    @include('components.backend.forms.select2.option2',['label'=> 'Payment Method','name' =>'payment_method','optionData' => $payment_methods])
                                    @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('payment_method')])
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="col-form-label">
                                    Payment Account:
                                </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    @include('components.backend.forms.select2.option2',['label' =>'Payment Account' ,'name' =>'payment_account','optionData' => $payment_accounts])
                                    @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('payment_account')])
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',['label'=> 'Due Amount', 'value'=>0, 'name' => 'due_amount','value'=>0 ,'readonly'=>true ,'placeholder' => 'due amount here...', ])
                                    @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('due_amount')])
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="col-form-label">
                                    Payment note:
                                </label>
                                <textarea name="payment_note" class="form-control" cols="30" rows="5"></textarea>
                            </div>
                        </div>

                        {{-- <hr>
                        <h6 style="text-align: right;">
                            Payment due: $ 0.00
                        </h6> --}}
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
    @include('backend.radiology.labTestJs')

    <script>
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
        $(document).on('change', '#discount_type', function() {
            discountCalculation();
        });

        //discount change event
        $(document).on('input', '#discount', function() {
            discountCalculation();
        });

        // discountCalculation
        discountCalculation = function() {
            let discountPrice = 0;
            let discount_type = $("#discount_type").val();
            let paid_amount = $('#paid_amount').val() || 0;
            let discount = $('#discount').val() || 0;
            let subtotal = $('#testSubTotal').val();
            let discount_amount = $('#discount_amount');
            console.log(discount_type);
            if (discount_type == 'flat') {
                discountPrice = Number(discount)
                discount_amount.val(discountPrice.toFixed(2));
            } else if (discount_type == 'percentage') {
                discountPrice = (Number(subtotal) * Number(discount)) / 100;

                discount_amount.val(discountPrice.toFixed(2));
            } else {
                discount_amount.val(0);
            }
            console.log(discountPrice, subtotal, discount, discount_type);
            $('#payable_amount').val((Number(subtotal) - Number(discountPrice)).toFixed(2));
            $('#due_amount').val(Number(subtotal) - Number(discountPrice) - Number(paid_amount)).toFixed(2);
        }

        // create a function to remove a row
        function removeRow(row) {
            $(row).closest('tr').remove();

        }

        approximatePrice = function() {
            var subtotal = tube_price = 0;
            $('.subtotal').each(function() {
                subtotal += Number($(this).val().replace(/[^0-9\.]+/g, ""));
            });
            $('#subTotal').val(subtotal.toFixed(2));
            var total = subtotal ;
            $('#testSubTotal').val(total.toFixed(2));
            $('#payable_amount').val(total.toFixed(2));
            $('#due_amount').val(total.toFixed(2));
            discountCalculation();
        }

        //paid amount change event
        $(document).on('input', '#paid_amount', function() {
            let paid_amount = $(this).val();
            let payable_amount = $('#payable_amount').val();
            let due_amount = $('#due_amount');
            if (Number(paid_amount) > Number(payable_amount)) {
                $(this).val(0);
              alert('Paid amount can not be greater than payable amount');
            } else {
                due_amount.val((Number(payable_amount) - Number(paid_amount)).toFixed(2));
            }
        });
    </script>
@endpush
