@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@section('page-header')
    <i class="fa fa-list"></i> Supplier List
@stop

@section('table_header')
@include('backend._partials.new_modal_page_header', [
    'fa' => 'fa fa-plus-circle',
    'name' => 'Create Supplier',
    'modelName' => 'create_data',
    'route' => route('backend.supplier.create')
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
            <div class="body">
                @yield('table_header')
                <div class="table-responsive">
                    <table ellspacing='0' class="table table-bordered text-center dataTable" id="supplier_table">
                        <thead>
                            <tr>
                                <th >Sl.</th>
                                <th >Name</th>
                                <th >Mobile</th>
                                <th >Email</th>
                                <th >Status</th>
                                <th >Action</th>
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
    $(function () {
        table_name =$("#supplier_table").DataTable({
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
                url : "{{ route('backend.supplier.index') }}",
                data : function ( d ) {
                    d.status = $('select#status').val()||true;
                },
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'mobile', name: 'mobile' },
                { data: 'email', name: 'email' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
        });
    });

    $('#create_data').click(function(e) {
        e.preventDefault();
        var modal = ".create_data";
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
        table_name.ajax.reload();
    }
</script>
@endpush

