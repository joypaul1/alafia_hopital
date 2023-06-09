@extends('backend.layout.app')
@include('backend._partials.datatable__delete')


@section('page-header')
<i class="fa fa-list"></i> Symptom Type Config
@stop

@section('content')


@include('backend._partials.page_header')

<div class="row">
    <div class="col-3">
        @include('backend.siteConfig.symptom.sidebar')
    </div>
    <div class="col-9">
        <div class="card">
            <div class="body">
                <div class="d-flex justify-content-between aling-items-center mb-4">
                    <h4 class="card-title mb-0">Symptom Type List</h4>
                    <a id="create_data" data-href="{{ route('backend.siteConfig.symptomType.create') }}" class="btn btn-info btn-md text-white">
                        <i class="fa fa-plus-circle me-2"></i> Create Type
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered " id="symptomType_table">
                        <thead>
                            <tr>
                                <th class="text-center">Sl.</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
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

<div class="modal fade symptomType_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role=" document">

    </div>
</div>

@endsection

@push('js')

<script>
    let table_name;
    var modal = ".symptomType_modal";
    $(function() {
        table_name = $("#symptomType_table").DataTable({
            dom: "Bfrtip"
            , buttons: ["colvis", "copy", "csv", "excel", "pdf", "print"
                , {
                    text: 'Reload'
                    , action: function(e, dt, node, config) {
                        dataBaseCall();
                    }
                }
            ]
            , processing: true
            , serverSide: true
            , destroy: true
            , pagingType: 'numbers'
            , pageLength: 10
            , ajax: "{{ route('backend.siteConfig.symptomType.index') }}"
            , ajax: {
                method: 'GET'
                , url: "{{ route('backend.siteConfig.symptomType.index') }}"
                , data: function(d) {
                    d.status = $('select#status').val() || true;
                }
            , }
            , columns: [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                }, {
                    data: 'name'
                    , name: 'name'
                    , "className": "text-center"
                },

                {
                    data: 'status'
                    , name: 'status'
                    , orderable: false
                    , searchable: false
                }, {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                }
            , ]
        , });
    });

    $('#create_data').click(function(e) {
        e.preventDefault();
        var modal = ".symptomType_modal";
        var href = $(this).data('href');

        // AJAX request
        $.ajax({
            url: href
            , type: 'GET'
            , dataType: "html"
            , success: function(response) {
                $(modal).modal('show');
                $(modal).find('.modal-dialog').html('');
                $(modal).find('.modal-dialog').html(response); // Add response in Modal body
            }
        });
    });
    $(document).on('click', '.edit_check', function() {

        var href = $(this).data('href');
        $.ajax({
            url: href
            , type: 'GET'
            , dataType: "html"
            , success: function(response) {
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

    $(document).on('submit', 'form#symptomType_edit_form', function(e) {
        e.preventDefault();
        var registerForm = $("form#symptomType_edit_form");
        var formData = registerForm.serialize();
        $('.edit_symptomType_button').attr('disabled', true);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            enctype: 'multipart/form-data'
            , url: $(this).attr('action')
            , type: 'PUT'
            , data: formData
            , success: function(res) {
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

            }
            , error: function(res) {
                var errors = res;
                console.log(errors.responseJSON.errors, 'errors');
                var myObject = errors.responseJSON.errors;
                for (var key in myObject) {
                    if (myObject.hasOwnProperty(key)) {
                        console.log(key + "/" + myObject[key]);
                        $("form#outlet_add_form input[name='" + key + "']").after("<div class='text-danger'><strong>" + ' ' + " </strong></div>");
                        $("form#outlet_add_form input[name='" + key + "']").after("<div class='text-danger'><strong>" + myObject[key] + " </strong></div>");
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


    $(document).on('submit', 'form#symptomType_add_form', function(e) {
        e.preventDefault();
        var registerForm = $("form#symptomType_add_form");
        var formData = registerForm.serialize();
        $('.save_symptomType_button').attr('disabled', true);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            enctype: 'multipart/form-data'
            , url: $(this).attr('action')
            , type: 'POST'
            , data: formData
            , success: function(res) {
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

            }
            , error: function(res) {
                var errors = res;
                console.log(errors.responseJSON.errors, 'errors');
                var myObject = errors.responseJSON.errors;
                for (var key in myObject) {
                    if (myObject.hasOwnProperty(key)) {
                        console.log(key + "/" + myObject[key]);
                        $("form#outlet_add_form input[name='" + key + "']").after("<div class='text-danger'><strong>" + ' ' + " </strong></div>");
                        $("form#outlet_add_form input[name='" + key + "']").after("<div class='text-danger'><strong>" + myObject[key] + " </strong></div>");
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
