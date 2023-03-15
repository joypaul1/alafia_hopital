@extends('backend.layout.app')
@include('backend._partials.datatable__delete')


@section('page-header')
    <i class="fa fa-list"></i> Symptom Config
@stop

@section('content')


    @include('backend._partials.page_header')

    <div class="row">
        {{-- <div class="col-3">
            @include('backend.siteConfig.bloodbank.sidebar')
        </div> --}}
        <div class="col-12">
            <div class="card">
                <div class="body">
                    <div class="d-flex justify-content-between aling-items-center mb-4">
                        <h4 class="card-title mb-0">Symptom List</h4>
                        <a id="create_data" data-href="{{ route('backend.siteConfig.symptom.create') }}"
                            class="btn btn-info btn-md text-white">
                            <i class="fa fa-plus-circle me-2"></i> Create Type
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="fullName" placeholder="Doctor Name" aria-label="name"
                                    aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <select name="designation" id="designation" class="form-control">
                                    <option value="">Select Designation</option>
                                    <option value="1">Doctor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <select name="depertment" id="depertment" class="form-control">
                                    <option value="">Select Depertment</option>
                                    <option value="1">Cardiology</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <select name="sepertment" id="specialist" class="form-control">
                                    <option value="">Specialist</option>
                                    <option value="1">Cardiology</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-center mt-5">
                        Apponintment Schedule
                    </h3>

                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <label for="day">
                                Day
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-calendar-check-o "></i>
                                    </span>
                                </div>
                                <select name="day" id="day" class="form-control">
                                    <option value="">Select Day</option>
                                    <option value="1">Saturday</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="start_time">
                                Start Time
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                </div>
                                <input name="start_time" type="time" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="end_time">
                                End Time
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                </div>
                                <input name="end_time" type="time" class="form-control" >
                            </div>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-info">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal HTML -->

    <div class="modal fade symptom_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role=" document">

        </div>
    </div>

@endsection

@push('js')
    <script>
        let table_name;
        var modal = ".symptom_modal";
        $(function() {
            // table_name =$("#bed_table").DataTable({
            //     dom: "Bfrtip",
            //     buttons: ["colvis","copy", "csv", "excel", "pdf", "print",
            //         {
            //             text: 'Reload',
            //             action: function ( e, dt, node, config ) {
            //                 dataBaseCall();
            //             }
            //         }
            //     ],
            //     processing: true,
            //     serverSide: true,
            //     destroy: true,
            //     pagingType: 'numbers',
            //     pageLength: 10,
            //     ajax: "{{ route('backend.siteConfig.symptom.index') }}",
            //     ajax: {
            //         method:'GET',
            //         url : "{{ route('backend.siteConfig.symptom.index') }}",
            //         data : function ( d ) {
            //             d.status = $('select#status').val()||true;
            //         },
            //     },
            //     columns: [{
            //             data: 'DT_RowIndex',
            //             name: 'DT_RowIndex'
            //         },
            //         {
            //             data: 'name',
            //             name: 'name'
            //         },{
            //             data: 'symptom_type_id',
            //             name: 'symptom_type_id'
            //         },{
            //             data: 'description',
            //             name: 'description'
            //         },

            //          {
            //             data: 'status',
            //             name: 'status',
            //             orderable: false,
            //             searchable: false
            //         }, {
            //             data: 'action',
            //             name: 'action',
            //             orderable: false,
            //             searchable: false
            //         },
            //     ],
            // });
        });

        $('#create_data').click(function(e) {
            e.preventDefault();
            var modal = ".symptom_modal";
            var href = $(this).data('href');
            console.log(href);
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

        $(document).on('submit', 'form#symptom_edit_form', function(e) {
            e.preventDefault();
            var registerForm = $("form#symptom_edit_form");
            var formData = registerForm.serialize();
            $('.edit_symptom_button').attr('disabled', true);

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
                            $("form#outlet_add_form input[name='" + key + "']").after(
                                "<div class='text-danger'><strong>" + ' ' + " </strong></div>");
                            $("form#outlet_add_form input[name='" + key + "']").after(
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


        $(document).on('submit', 'form#symptom_add_form', function(e) {
            e.preventDefault();
            var registerForm = $("form#symptom_add_form");
            var formData = registerForm.serialize();
            $('.save_symptom_button').attr('disabled', true);

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
                            console.log(key + "/" + myObject[key]);
                            $("form#outlet_add_form input[name='" + key + "']").after(
                                "<div class='text-danger'><strong>" + ' ' + " </strong></div>");
                            $("form#outlet_add_form input[name='" + key + "']").after(
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
