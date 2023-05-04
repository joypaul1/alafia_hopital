@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@push('css')
    <style>
        .dropdown_hover a {
            text-decoration: none;
        }
        .incom_color li{
           background:  darkorange
        }
        .com_color li{
           background:  #03045e
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

@section('content')
    @include('backend._partials.page_header')

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="body">
                    <div class="d-flex justify-content-between aling-items-center mb-4">
                        <h4 class="card-title mb-0">LabTest List</h4>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered " id="labTest_table">
                            <thead>
                                <tr>
                                    <th class="text-center">Sl.</th>
                                    <th class="text-center">Created Date </th>
                                    <th class="text-center">P-Name</th>
                                    <th class="text-center">View Test</th>
                                    <th class="text-center">Print Bar Code</th>
                                    <th class="text-center">Make Result</th>
                                    <th class="text-center">View Result </th>
                                    <th class="text-center">Print Result </th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($labInvoices as $key => $labInvoice)
                                    <tr class="text-center">
                                        <td>{{ $labInvoice['invoice_no'] }}</td>
                                        <td> {{ date('d-m-y', strtotime($labInvoice['date'])) }}</td>
                                        <td>{{ $labInvoice->patient->name }}
                                            <br>
                                            <a target="_blank" href="{{ route('backend.patient.show',$labInvoice->patient->id) }}" target="_blank">
                                                <button class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('backend.pathology.printTest',$labInvoice) }}" target="_blank">
                                                <button class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                            </a>

                                        </td>
                                        <td></td>
                                        <td >
                                            <div class="dropdown_hover incom_color">
                                                <ul>

                                                    <li><a href="#" aria-haspopup="true">InComplete Test</a>
                                                        <ul class="dropdown" aria-label="submenu">
                                                            @foreach ($labInvoice->labTestDetails->where('status', '!=', 'completed') as $labTestDetails)
                                                                <li><a target="_blank" href="{{ route('backend.pathology.make-test-result', ['labTest_id' => $labTestDetails->lab_test_id,'labDetails_id' => $labTestDetails->id]) }}">
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
                                                    <li><a href="#" aria-haspopup="true" >Complete Test</a>
                                                        <ul class="dropdown" aria-label="submenu">
                                                            @foreach ($labInvoice->labTestDetails->where('status', 'completed') as $labTestDetails)
                                                                <li>
                                                                    <a target="_blank" href="{{ route('backend.pathology.make-test-result-show', ['labTest_id' => $labTestDetails->lab_test_id,'labDetails_id' => $labTestDetails->id]) }}">
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
    {{-- <script>
        let table_name;
        var modal = ".labTest_modal";
        $(function() {
            table_name = $("#labTest_table").DataTable({
                dom: "Bfrtip",
                buttons: ["colvis", "copy", "csv", "excel", "pdf", "print", {
                    text: 'Reload',
                    action: function(e, dt, node, config) {
                        dataBaseCall();
                    }
                }],
                processing: true,
                serverSide: true,
                destroy: true,
                pagingType: 'numbers',
                pageLength: 10,
                ajax: "{{ route('backend.siteConfig.labTest.index') }}",
                ajax: {
                    method: 'GET',
                    url: "{{ route('backend.siteConfig.labTest.index') }}",
                    data: function(d) {
                        d.status = $('select#status').val() || true;
                    },
                },
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                }, {
                    data: 'name',
                    name: 'name',
                    "className": "text-center"
                }, {
                    data: 'lab_test_tube_id',
                    name: 'lab_test_tube_id',
                    "className": "text-center"
                }, {
                    data: 'price',
                    name: 'price',
                    className: "text-center",
                }, {
                    data: 'status',
                    name: 'status',
                    "className": "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }]
            });
        });

        $('#create_data').click(function(e) {
            e.preventDefault();
            var modal = ".labTest_modal";
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
        $(document).on('click', '.edit_check', function() {

            var href = $(this).data('href');
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


        $('#toggleFilter').click(() => {
            $('#filterContainer').slideToggle();
        })

        function dataBaseCall() {
            table_name.ajax.reload();
        }

        $(document).on('submit', 'form#labTest_edit_form', function(e) {
            e.preventDefault();
            var registerForm = $("form#labTest_edit_form");
            var formData = registerForm.serialize();
            $('.edit_labTest_button').attr('disabled', true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                enctype: 'multipart/form-data',
                url: $(this).attr('action'),
                type: 'PUT',
                data: formData,
                success: function(res) {
                    console.log(res);
                    if (res.status) {
                        $(modal).modal('hide');
                        dataBaseCall();
                        let $message = res.success;
                        let $context = 'success';
                        let $positionClass = 'toast-top-right';
                        toastr.remove();
                        toastr[$context]($message, '', {
                            positionClass: $positionClass
                        });
                    } else {
                        let $message = res.errors;
                        let $context = 'error';
                        let $positionClass = 'toast-top-right';
                        toastr.remove();
                        toastr[$context]($message, '', {
                            positionClass: $positionClass
                        });
                    }

                },
                error: function(res) {
                    var errors = res;
                    console.log(errors.responseJSON.errors, 'errors');
                    var myObject = errors.responseJSON.errors;
                    for (var key in myObject) {
                        if (myObject.hasOwnProperty(key)) {
                            console.log(key + "/" + myObject[key]);
                            $("form#labTest_edit_form input[name='" + key + "']").after(
                                "<div class='text-danger'><strong>" + ' ' + " </strong></div>");
                            $("form#labTest_edit_form input[name='" + key + "']").after(
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


        $(document).on('submit', 'form#labTest_add_form', function(e) {
            e.preventDefault();
            var registerForm = $("form#labTest_add_form");
            var formData = registerForm.serialize();
            $('.save_labTest_button').attr('disabled', true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                enctype: 'multipart/form-data',
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(res) {
                    console.log(res);
                    if (res.status) {
                        $(modal).modal('hide');
                        dataBaseCall();
                        let $message = res.success;
                        let $context = 'success';
                        let $positionClass = 'toast-top-right';
                        toastr.remove();
                        toastr[$context]($message, '', {
                            positionClass: $positionClass
                        });
                    } else {
                        let $message = res.errors;
                        let $context = 'error';
                        let $positionClass = 'toast-top-right';
                        toastr.remove();
                        toastr[$context]($message, '', {
                            positionClass: $positionClass
                        });
                    }

                },
                error: function(res) {
                    var errors = res;
                    console.log(errors.responseJSON.errors, 'errors');
                    var myObject = errors.responseJSON.errors;
                    for (var key in myObject) {
                        if (myObject.hasOwnProperty(key)) {
                            $("form#labTest_add_form input[name='" + key + "']").after(
                                "<div class='text-danger'><strong>" + ' ' + " </strong></div>");
                            $("form#labTest_add_form input[name='" + key + "']").after(
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
    </script> --}}
@endpush
