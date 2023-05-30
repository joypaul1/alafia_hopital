@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
@endpush
@section('page-header')
    <i class="fa fa-list"></i> Doctor Income Summary
@stop
@section('table_header')
    @include('backend._partials.page_header', [
        // 'fa' => 'fa fa-check-circle',
        // 'name' => 'Doctor Income History',
        // 'route' => route('backend.pathology.labTest.index'),
    ])
@stop
@section('content')


    <div class="row">

        <div class="col-12">

            <div class="card">
                <div class="body">
                    <h4 class="pointer text-info" id="toggleFilter">
                        <i class="fa fa-filter"></i> Filter
                    </h4>
                    <form action="{{ route('backend.paymentdoctor.index') }}" method="get">
                        @method('GET')
                        <div id="filterContainer">
                            <hr>
                            <div class="row align-items-center">

                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        @include('components.backend.forms.select2.option', [
                                            'label' => 'Select Department',
                                            'name' => 'department_id',
                                            'optionData' => $department,
                                            'selectedKey' => request()->get('department_id'),
                                        ])
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        @include('components.backend.forms.select2.option', [
                                            'label' => 'Select Doctor',
                                            'name' => 'doctor_id',
                                            'optionData' => $doctor,
                                            'selectedKey' => request()->get('doctor_id'),
                                        ])
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        @include('components.backend.forms.input.submit-button', [
                                            'name' => 'submit',
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card border-top">
                @yield('table_header')

                <div class="body">
                    @if (request()->get('doctor_id'))
                        <div class="d-flex justify-content-between">
                            <div></div>
                            <h5>Doctor Income Ledger</h5>



                        </div>
                    @endif


                    <div class="table-responsive">
                        <table class="table table-bordered " id="">
                            <thead>
                                <tr>
                                    <th class="text-center">Doctor Name </th>
                                    <th class="text-center">Debit</th>
                                    <th class="text-center">Credit</th>
                                    <th class="text-center">Balance</th>
                                </tr>
                            </thead>
                            @if (request()->get('doctor_id'))
                                <tr>
                                    <td class="text-center">{{ $history->first_name . ' ' . $history->last_name }}</td>
                                    <td class="text-right">{{ number_format(optional($history->ledger)->debit ?? 0, 2) }}
                                    </td>
                                    <td class="text-right">{{ number_format(optional($history->ledger)->credit ?? 0, 2) }}
                                    </td>
                                    <td class="text-right">{{ number_format(optional($history->ledger)->balance ?? 0, 2) }}
                                    </td>
                                </tr>
                            @endif

                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    @if (request()->get('doctor_id'))
                        <div class="card border-top">
                            <form action="{{ route('backend.paymentdoctor.update', $history->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="doctor_id" value="{{ request()->get('doctor_id') }}">
                                <div class="card-body">
                                    <h5>
                                        Add Payment
                                    </h5>

                                    <div class="d-flex col-12 justify-content-center text-center">
                                        @include('components.backend.forms.input.input-type', [
                                            'label' => 'Payable Amount',
                                            'value' => $history->ledger->balance ?? 0,

                                            'name' => 'payable_amount',
                                            'placeholder' => 'Payable amount here...',
                                            'readonly' => true,
                                            'class' => 'text-center',
                                        ])
                                        @include('components.backend.forms.input.errorMessage', [
                                            'message' => $errors->first('payable_amount'),
                                        ])
                                    </div>
                                    <section id="multiple_payment_row">
                                        <div class="row align-items-center multiple_payment_row_card">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    @include('components.backend.forms.input.input-type', [
                                                        'label' => 'Paid Amount',
                                                        'name' => 'paid_amount',
                                                        'placeholder' => 'Enter amount here...',
                                                        'required' => true
                                                    ])
                                                    @include(
                                                        'components.backend.forms.input.errorMessage',
                                                        [
                                                            'message' => $errors->first('paid_amount'),
                                                        ]
                                                    )
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
                                                    @include('components.backend.forms.select2.option2', [
                                                        'label' => 'Payment Method',
                                                        'name' => 'payment_method',
                                                        'optionData' => $payment_methods,
                                                        'required' => true

                                                    ])
                                                    @include(
                                                        'components.backend.forms.input.errorMessage',
                                                        [
                                                            'message' => $errors->first('payment_method'),
                                                        ]
                                                    )
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
                                                    @include('components.backend.forms.select2.option2', [
                                                        'label' => 'Payment Account',
                                                        'name' => 'payment_account',
                                                        'optionData' => $payment_accounts,
                                                        'required' => true
                                                    ])
                                                    @include(
                                                        'components.backend.forms.input.errorMessage',
                                                        [
                                                            'message' => $errors->first('payment_account'),
                                                        ]
                                                    )
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="col-form-label">
                                                    Payment note:
                                                </label>
                                                <textarea name="payment_note" class="form-control" cols="10" rows="2"></textarea>
                                            </div>



                                        </div>
                                    </section>
                                    <div class="d-flex col-12 justify-content-center text-center">

                                        @include('components.backend.forms.input.input-type', [
                                            'label' => 'Due Amount',
                                            'value' => 0,
                                            'name' => 'due_amount',
                                            'value' => $history->ledger->balance ?? 0,
                                            'readonly' => true,
                                            'class' => 'text-center',
                                            'placeholder' => 'due amount here...',
                                        ])
                                        @include('components.backend.forms.input.errorMessage', [
                                            'message' => $errors->first('due_amount'),
                                        ])
                                    </div>
                                    <div class="d-flex col-12 justify-content-center">

                                        <button type="submit" class=" btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('assets/backend/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('#start_date').datepicker({
            format: 'mm-dd-yyyy',
            startDate: '-5y'

        });
        $('#end_date').datepicker({
            format: 'mm-dd-yyyy',
            startDate: '-5y'

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
                    $('#doctor_id').html(' ');
                    $.map(res.data, function(val, i) {
                        var newOption = new Option('-select Doctor-', null, false, false);
                        var newOption = new Option(val.name, val.id, false, false);
                        $('#doctor_id').append(newOption);

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
        });
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
