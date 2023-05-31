@extends('backend.layout.app')
@include('backend._partials.datatable__delete')
@push('css')

@endpush

@section('page-header')
<i class="fa fa-list"></i> Reference List
@stop

@section('table_header')
@include('backend._partials.modal_page_header', [
'fa' => 'fa fa-plus-circle',
'name' => 'Create Reference',
'modelName' => 'create_data',
'route' => route('backend.reference.create')
])

@stop
@section('content')


<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="body">
                <h4 class="pointer text-info" id="toggleFilter">
                    <i class="fa fa-filter"></i> Filter
                </h4>
                <div id="filterContainer">
                    <hr>

                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                @include('components.backend.forms.select2.option',[ 'label'=> 'status', 'name' => 'status','onchange'=>true,  'optionData' => $status ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-top">
            @yield('table_header')
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center dataTable" id="reference_table">
                        <thead>
                            <tr>
                                <th class="text-center">Sl.</th>
                                <th class="text-center">Name</th>
                                {{-- <th class="text-center">Slug</th> --}}
                                {{-- <th class="text-center">Image</th> --}}
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

<div class="modal fade reference_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg"" role=" document">
        <div class="modal-content">

        </div>
    </div>
</div>
@endsection

@push('js')

<script>
    let table_name ;
    var modal = ".reference_modal";
    $(function() {
        table_name =$("#reference_table").DataTable({
            dom: "Bfrtip",
            buttons: ["colvis","copy", "csv", "excel", "pdf", "print",
                {
                    text: 'Reload',
                    action: function ( e, dt, node, config ) {
                        dataBaseCall();
                    }
                }
            ],
            processing: true,
            serverSide: true,
            destroy: true,
            pagingType: 'numbers',
            pageLength: 10,
            ajax: "{{ route('backend.reference.index') }}",
            ajax: {
                method:'GET',
                url : "{{ route('backend.reference.index') }}",
                data : function ( d ) {
                    d.status = $('select#status').val()||true;
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                }, {
                    data: 'name',
                    name: 'name'
                },
                // {
                //     data: 'slug',
                //     name: 'slug'
                // },

                // {
                //     data: "image",
                //     render: function(img) {
                //         return '<img src="' + img + '" alt="no-image" height="100px" width="100" >';
                //     },
                //     orderable: false,
                //     searchable: false
                // },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });
    });

    $('#create_data').click(function(e) {
        e.preventDefault();
        var modal = ".reference_modal";
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
    $(document).on('click', '.edit_check', function(){

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
    function dataBaseCall(){
        table_name.ajax.reload();
    }

    $(document).on('submit', 'form#reference_edit_form', function(e) {
        e.preventDefault();
        var registerForm = $("form#reference_edit_form");
        var formData = registerForm.serialize();
        $('.edit_reference_button').attr('disabled',true);

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
                if(res.status){
                    $(modal).modal('hide');
                    dataBaseCall();
                    let $message = res.success;
                    let $context = 'success';
                    let $positionClass= 'toast-top-right';
                    toastr.remove();
                    toastr[$context]($message, '', {
                        positionClass: $positionClass
                    });
                }else{
                    let $message = res.errors ;
                    let $context = 'error';
                    let $positionClass= 'toast-top-right';
                    toastr.remove();
                    toastr[$context]($message, '', {
                        positionClass: $positionClass
                    });
                }

            },error:function(res){
                var errors =res;
                console.log(errors.responseJSON.errors, 'errors');
                var myObject = errors.responseJSON.errors;
                for (var key in myObject) {
                if (myObject.hasOwnProperty(key)) {
                    console.log(key + "/" + myObject[key]);
                    $("form#outlet_add_form input[name='" + key + "']").after("<div class='text-danger'><strong>" + ' ' + " </strong></div>");
                    $("form#outlet_add_form input[name='" + key + "']").after("<div class='text-danger'><strong>" + myObject[key] + " </strong></div>");
                        let $message = myObject[key] ;
                        let $context = 'error';
                        let $positionClass= 'toast-top-right';
                        toastr.remove();
                        toastr[$context]($message, '', {
                            positionClass: $positionClass
                        });
                    }

                }

            }
        });
    });


    $(document).on('submit', 'form#reference_add_form', function(e) {
        e.preventDefault();
        var registerForm = $("form#reference_add_form");
        var formData = registerForm.serialize();
        $('.save_reference_button').attr('disabled',true);

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
                if(res.status){
                    $(modal).modal('hide');
                    dataBaseCall();
                    let $message = res.success;
                    let $context = 'success';
                    let $positionClass= 'toast-top-right';
                    toastr.remove();
                    toastr[$context]($message, '', {
                        positionClass: $positionClass
                    });
                }else{
                    let $message = res.errors ;
                    let $context = 'error';
                    let $positionClass= 'toast-top-right';
                    toastr.remove();
                    toastr[$context]($message, '', {
                        positionClass: $positionClass
                    });
                }

            },error:function(res){
                var errors =res;
                console.log(errors.responseJSON.errors, 'errors');
                var myObject = errors.responseJSON.errors;
                for (var key in myObject) {
                if (myObject.hasOwnProperty(key)) {
                    console.log(key + "/" + myObject[key]);
                    $("form#outlet_add_form input[name='" + key + "']").after("<div class='text-danger'><strong>" + ' ' + " </strong></div>");
                    $("form#outlet_add_form input[name='" + key + "']").after("<div class='text-danger'><strong>" + myObject[key] + " </strong></div>");
                        let $message = myObject[key] ;
                        let $context = 'error';
                        let $positionClass= 'toast-top-right';
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
