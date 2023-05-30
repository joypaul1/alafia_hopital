@extends('backend.layout.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
@endpush
@section('page-header')
    <i class="fa fa-list"></i> Radiology Payment
@stop
@section('table_header')
    @include('backend._partials.page_header', [
        'fa' => 'fa fa-plus-circle',
        'name' => 'Radiology Invoice list',
        'route' => route('backend.radiologyServiceInvoice.index'),
    ])
@stop
@section('content')


    <div class="row">

        <div class="col-12">
            <div class="card border-top">
                @yield('table_header')

                <div class="body">
                    <div class="card text-center">
                        <h3>
                            <span class="badge badge-info">Invoice No: {{ $labInvoice->invoice_no }}</span>
                            <span class="badge badge-info">Patient Name: {{ $labInvoice->patient->name }}</span>

                        </h3>
                        <form action="{{ route('backend.radiology.payment.store',$labInvoice) }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="body row">
                                <div class="col-3 form-group">
                                    <label class="col-form-label" for="start_date"> Start Date</label>
                                    <div class="input-group ">
                                        <input value="{{ request()->get('date') ?? date('y-m-d') }}" autocomplete="off"
                                            data-provide="datepicker" data-date-autoclose="true" id="start_date"
                                            name="date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">

                                        <label class="col-form-label" for="payable_amount">
                                            Payable amount
                                        </label>

                                        <input type="text" name="payable_amount" class="form-control" id="payable_amount"
                                            placeholder="payable_amount" value="{{ number_format($labInvoice->due_amount, 2, '.', '') }}"
                                            autocomplete="off" readonly="">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">

                                        <label class="col-form-label" for="paid_amount">
                                            Paid amount
                                        </label>

                                        <input type="text" name="paid_amount" class="form-control" id="paid_amount"
                                            min="0" step="0.01" title="amount" pattern="^\d+(?:\.\d{1,2})?$"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            placeholder="paid amount here.." value="{{ null }}" autocomplete="off"
                                            required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">

                                        <label class="col-form-label" for="due_amount">

                                            Due amount
                                        </label>

                                        <input type="text" name="due_amount" class="form-control" id="due_amount"
                                            placeholder="due_amount" value="{{ number_format($labInvoice->due_amount,2, '.', '') }}"
                                            autocomplete="off" readonly="">
                                    </div>
                                </div>
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('assets/backend/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $('#start_date').datepicker({
           format: 'dd-mm-yyyy',
            startDate: '-5y'

        });
        //paid amount change event
        $(document).on('input', '#paid_amount', function() {
            let paid_amount = $(this).val();
            let payable_amount = $('#payable_amount').val();
            let due_amount = $('#due_amount');
            if (Number(paid_amount) > Number(payable_amount)) {
                let $message = "Not More Than Payable Amount! &#128528; ";
                let $context = 'error';
                let $positionClass = 'toast-top-right';
                toastr.remove();
                toastr[$context]($message, '', {
                    positionClass: $positionClass
                });
                $(this).val(0);
                due_amount.val(Number(payable_amount));
            } else {
                due_amount.val((Number(payable_amount) - Number(paid_amount)).toFixed(2));
            }
        });
    </script>
@endpush
