@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">

    <style>
        .dropdown_hover a {
            text-decoration: none;
        }

        .incom_color li {
            background: darkorange
        }

        .com_color li {
            background: #03045e
        }

        /* nav {
                                                                        font-family: monospace;
                                                                    } */

        .dropdown_hover ul {
            /* background: darkorange; */
            list-style: none;
            margin: 0;
            padding-left: 0;
        }

        .dropdown_hover li {
            color: #fff;
            /* background: darkorange; */
            display: block;
            float: left;
            padding: 1rem;
            position: relative;
            text-decoration: none;
            transition-duration: 0.5s;
        }

        .dropdown_hover li a {
            color: #fff;
            text-decoration: none;
        }

        .dropdown_hover li:hover,
        .dropdown_hover li:focus-within {
            background: red;
            cursor: pointer;
        }

        .dropdown_hover li:focus-within a {
            outline: none;
        }

        .dropdown_hover ul li ul {
            background: orange;
            visibility: hidden;
            opacity: 0;
            min-width: 5rem;
            position: absolute;
            transition: all 0.5s ease;
            margin-top: 1rem;
            left: 0;
            display: none;
        }

        .dropdown_hover ul li:hover>ul,
        .dropdown_hover ul li:focus-within>ul,
        .dropdown_hover ul li ul:hover,
        .dropdown_hover ul li ul:focus {
            visibility: visible;
            opacity: 1;
            display: block;
            z-index: 999999;
        }

        .dropdown_hover ul li ul li {
            clear: both;
            width: 100%;
        }
    </style>
@endpush
@section('page-header')
    <i class="fa fa-list"></i> LabTest Config
@stop
@section('table_header')
    @include('backend._partials.page_header', [
        'fa' => 'fa fa-plus-circle',
        'name' => 'LabTest Invoice list',
        'route' => route('backend.pathology.labTest.index'),
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
                    <form action="{{ route('backend.pathology.labTest.index', ['status'=> 'readyToDelivery']) }}" method="get">
                        @method('GET')
                        <input type="hidden" name="status" value="readyToDelivery">

                        <div id="filterContainer">
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="invoice_no">Invoice no</label>
                                        <input type="text" name="invoice_no" id="invoice_no" class="form-control"
                                            autocomplete="off" placeholder="invoice number"
                                            value="{{ request()->get('invoice_no') }}" autofocus='true'>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="patient_id">Patient Id </label>
                                        <input type="text" name="patient_id" id="patient_id" class="form-control"
                                            autocomplete="off" value="{{ request()->get('patient_id') }}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="patient_name">Patient Name </label>
                                        <input type="text" name="patient_name" id="patient_name" class="form-control"
                                            autocomplete="off" value="{{ request()->get('patient_name') }}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="mobile_number">Patient Mobile No. </label>
                                        <input type="text" name="mobile_number" id="mobile_number" class="form-control"
                                            autocomplete="off" value="{{ request()->get('mobile_number') }}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label>Start Date</label>
                                    <div class="input-group mb-3">
                                        <input value="{{ request()->get('start_date') ?? date('y-m-d') }}"
                                            autocomplete="off" data-provide="datepicker" data-date-autoclose="true"
                                            id="start_date" name="start_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <label>End Date</label>
                                    <div class="input-group mb-3">
                                        <input value="{{ request()->get('end_date') ?? date('y-m-d') }}" autocomplete="off"
                                            data-provide="datepicker" data-date-autoclose="true" id="end_date"
                                            name="end_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        @include('components.backend.forms.select2.option', [
                                            'label' => 'Payment Status',
                                            'name' => 'payment_status',
                                            'optionData' => $payment_status,
                                            'selectedKey' => request()->get('payment_status'),
                                        ])
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        @include('components.backend.forms.input.submit-button', [
                                            // 'label' => 'status',
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

                    <div class="table-responsive">
                        <table class="table table-bordered " id="labTest_table">
                            <thead>
                                <tr>
                                    <th class="text-center">Invoice No.</th>
                                    <th class="text-center">Created Date </th>
                                    <th class="text-center">P-Name</th>
                                    <th class="text-center">View Test</th>
                                    <th class="text-center">Make Result</th>
                                    <th class="text-center">View Result </th>
                                    <th class="text-center">Print Result </th>
                                    <th class="text-center">Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($labInvoices as $key => $labInvoice)
                                    <tr class="text-center">
                                        <td>{{ $labInvoice['invoice_no'] }}</td>
                                        <td> {{ date('d-m-y', strtotime($labInvoice['date'])) }}</td>
                                        <td>{{ $labInvoice->patient->name }}
                                            <br>
                                            <a target="_blank"
                                                href="{{ route('backend.patient.show', $labInvoice->patient->id) }}"
                                                target="_blank">
                                                <button class="btn btn-success"><i class="fa fa-eye"
                                                        aria-hidden="true"></i></button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('backend.pathology.printTest', $labInvoice) }}"
                                                target="_blank">
                                                <button class="btn btn-info"><i class="fa fa-eye"
                                                        aria-hidden="true"></i></button>
                                            </a>

                                        </td>

                                        <td>
                                            <div class="dropdown_hover incom_color">
                                                <ul>

                                                    <li><a href="#" aria-haspopup="true">InComplete Test</a>
                                                        <ul class="dropdown" aria-label="submenu">
                                                            @foreach ($labInvoice->labTestDetails->where('status', '!=', 'completed') as $labTestDetails)
                                                                <li><a target="_blank"
                                                                        href="{{ route('backend.pathology.make-test-result', ['labTest_id' => $labTestDetails->lab_test_id, 'labDetails_id' => $labTestDetails->id]) }}">
                                                                        {{ $labTestDetails->testName->name }}</a>
                                                                </li>
                                                            @endforeach

                                                        </ul>
                                                    </li>

                                                </ul>
                                            </div>
                                        </td>

                                        <td>

                                            <div class="dropdown_hover com_color">
                                                <ul>
                                                    <li><a href="#" aria-haspopup="true">Complete Test</a>
                                                        <ul class="dropdown" aria-label="submenu">
                                                            @foreach ($labInvoice->labTestDetails->where('status', 'completed') as $labTestDetails)
                                                                <li>
                                                                    <a target="_blank"
                                                                        href="{{ route('backend.pathology.make-test-result-show', ['labTest_id' => $labTestDetails->lab_test_id, 'labDetails_id' => $labTestDetails->id]) }}">
                                                                        {{ $labTestDetails->testName->name }}</a>
                                                                </li>
                                                            @endforeach

                                                        </ul>
                                                    </li>

                                                </ul>
                                            </div>

                                        </td>
                                        <td>
                                            @php
                                                $categoryData = $labInvoice->labTestDetails
                                                    ->pluck('testName.category')
                                                    ->unique()
                                                    ->all();
                                            @endphp
                                            @foreach ($categoryData as $cat)
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('backend.pathology.printCat', ['invoice_id' => $labInvoice->id, 'category' => $cat]) }}">
                                                    {{ $cat }} <i class="fa fa-print " aria-hidden="true"></i>
                                            @endforeach

                                            </a>
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('backend.pathology.labTest.changeStatus', ['status' => 'delivered', 'id' => $labInvoice->id]) }}">
                                                <button class="btn btn-warning"><i class="fa fa-check-circle"
                                                        aria-hidden="true"></i> Move To Delivered</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
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
        $('#end_date').datepicker({
           format: 'dd-mm-yyyy',
            startDate: '-5y'

        });
    </script>
@endpush
