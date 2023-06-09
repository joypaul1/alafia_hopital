@extends('backend.layout.app')
@include('backend._partials.datatable__delete')


@section('page-header')
    <i class="fa fa-list"></i> LabTest Config
@stop

@section('content')

    @include('backend._partials.page_header')

    <div class="row">
        <div class="col-2">
            @include('backend.siteConfig.labTest.sidebar')
        </div>
        <div class="col-10">
            <div class="card">
                <div class="body">
                    <div class="d-flex justify-content-between aling-items-center mb-4">
                        <h4 class="card-title mb-0">LabTest List</h4>
                        <a href="{{ route('backend.siteConfig.labTest.create') }}"
                            class="btn btn-info btn-md text-white">
                            <i class="fa fa-plus-circle me-2"></i> Create LabTest
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered " id="labTest_table">
                            <thead>
                                <tr>
                                    <th class="text-center">Sl.</th>
                                    <th class="text-center">Action</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">BarCode Name</th>
                                    <th class="text-center">Tube </th>
                                    <th class="text-center">Department</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Delivery Time</th>
                                </tr>
                            </thead>

                            <tbody>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal HTML -->

    <div class="modal fade labTest_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role=" document">

        </div>
    </div>

@endsection

@push('js')
    <script>
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
                pageLength: 50,
                ajax: "{{ route('backend.siteConfig.labTest.index') }}",
                ajax: {
                    method: 'GET',
                    url: "{{ route('backend.siteConfig.labTest.index') }}",
                    data: function(d) {
                        d.status = $('select#status').val() || true;
                    },
                },
                columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name',
                    "className": "text-center"
                }, {
                    data: 'short_name',
                    name: 'short_name',
                    "className": "text-center"
                }, {
                    data: 'lab_test_tube_id',
                    name: 'lab_test_tube_id',
                    "className": "text-center"
                },
                {
                    data: 'category',
                    name: 'category',
                    "className": "text-center",
                    // orderable: false,
                    // searchable: false
                },{
                    data: 'price',
                    name: 'price',
                    "className": "text-center"
                }, {
                    data: 'delivery_time',
                    name: 'delivery_time',
                    className: "text-center",
                }
                ]
            });
        });

        // $('#create_data').click(function(e) {
        //     e.preventDefault();
        //     var modal = ".labTest_modal";
        //     var href = $(this).data('href');

        //     // AJAX request
        //     $.ajax({
        //         url: href,
        //         type: 'GET',
        //         dataType: "html",
        //         success: function(response) {
        //             $(modal).modal('show');
        //             $(modal).find('.modal-dialog').html('');
        //             $(modal).find('.modal-dialog').html(response); // Add response in Modal body
        //         }
        //     });
        // });
        // $(document).on('click', '.edit_check', function() {

        //     var href = $(this).data('href');
        //     $.ajax({
        //         url: href,
        //         type: 'GET',
        //         dataType: "html",
        //         success: function(response) {
        //             $(modal).modal('show');
        //             $(modal).find('.modal-dialog').html('');
        //             $(modal).find('.modal-dialog').html(response); // Add response in Modal body
        //         }
        //     });
        // });


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
    </script>
@endpush
