@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@section('page-header')
    <i class="fa fa-list"></i> Warehouse List
@stop

@section('table_header')
@include('backend._partials.new_modal_page_header', [
    'fa' => 'fa fa-plus-circle',
    'name' => 'Create Warehouse',
    'modelName' => 'create_data',
    'route' => route('backend.inventory.warehouse.create')
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
                                @include('components.backend.forms.select2.option',[ 'label'=> 'country',  'name' => 'country_id','onclick'=>true , 'optionData' => $countries ])
                            </div>
                        </div>
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
            <div class="body">
                @yield('table_header')
                <div class="table-responsive">
                    <table ellspacing='0' class="table table-bordered text-center dataTable" id="warehouse_table">
                        <thead>
                            <tr>
                                <th class="text-center">Sl.</th>
                                <th class="text-center">Action</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Province</th>
                                <th class="text-center">City</th>
                                <th class="text-center">Country</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal HTML -->
<div class="modal fade create_data" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg"" role=" document">

    </div>
</div>
@endsection

@push('js')
<script>
    let table_name;
    var modal = ".create_data";
    $(function () {
        table_name =$("#warehouse_table").DataTable({
            dom: "Bfrtip",
            buttons: ["colvis","copy", "csv", "excel", "pdf", "print",
                {
                    text: 'Reload',
                    action: function ( e, dt, node, config ) {
                        table_name.ajax.reload();
                    }
                }
            ],
            processing: true,
            serverSide: true,
            destroy: true,
            pagingType: 'numbers',
            pageLength: 10,
            ajax: {
                method:'GET',
                url : "{{ route('backend.inventory.warehouse.index') }}",
                data : function ( d ) {
                    d.country_id = $('select#country_id').val();
                    d.status = $('select#status').val()||true;
                },
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'mobile', name: 'mobile' },
                { data: 'email', name: 'email' },
                { data: 'province', name: 'province' },
                { data: 'city', name: 'city' },
                { data: 'country_id', name: 'country_id' },
                { data: 'status', name: 'status' },

            ],
        });


    });

    $('#create_data').click(function(e) {
        e.preventDefault();

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
    $('#toggleFilter').click(() => {
        $('#filterContainer').slideToggle();
    })

    function dataBaseCall(){
        console.log('call');
        table_name.ajax.reload();
    }


    $(document).on('submit', 'form#warehouse_add_form', function(e) {
        e.preventDefault();
        var warehouseForm = $("form#warehouse_add_form");
        var formData = warehouseForm.serialize();
        $('.save_warehouse_button').attr('disabled',true);
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
                let $message = res.mes;
                let $context = res.status == true ? 'success' : 'error';
                let $positionClass = 'toast-top-right';
                toastr.remove();
                toastr[$context]($message, '', {
                    positionClass: $positionClass
                });
                if (res.status) {
                    $(modal).modal('hide');
                    dataBaseCall();
                }

            },error:function(res){
                var errors =res;
                console.log(errors.responseJSON.errors, 'errors');
                var myObject = errors.responseJSON.errors;
                for (var key in myObject) {
                if (myObject.hasOwnProperty(key)) {
                    console.log(key + "/" + myObject[key]);
                    $("form#warehouse_add_form input[name='" + key + "']").after("<div class='text-danger'><strong>" + ' ' + " </strong></div>");
                    $("form#warehouse_add_form input[name='" + key + "']").after("<div class='text-danger'><strong>" + myObject[key] + " </strong></div>");
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

        table_name.ajax.reload();
    });

</script>
@endpush

