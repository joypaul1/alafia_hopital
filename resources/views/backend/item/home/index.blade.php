@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@section('page-header')
    <i class="fa fa-list"></i> Item List
@stop
@section('table_header')
@include('backend._partials.new_page_header', [
    'fa' => 'fa fa-plus-circle',
    'name' => 'Create Item',
    'route' => route('backend.itemconfig.item.create')
])
@stop
@section('content')


<div class="row">
    <div class="col-lg-12">
        @include('backend.item.home.filter')
        <div class="card">
            @yield('table_header')
            <div class="body">
                <div class="table-responsive">
                    <table ellspacing='0' class="table table-bordered text-center dataTable item_table">
                        <thead  >
                            <tr >
                                <th class="text-center"> Sl.</th>
                                <th class="text-center"> Name</th>
                                <th class="text-center"> Category</th>
                                <th class="text-center"> Subcategory</th>
                                {{-- <th class="text-center"> Childcategory</th> --}}
                                <th class="text-center"> Sell Price</th>
                                {{-- <th class="text-center"> Brand</th> --}}
                                <th class="text-center"> Status</th>
                                <th class="text-center"> Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')
<script>

    var config = {
        routes: {
            unit            : "{{route('backend.itemconfig.unit.index') }}",
            brand           : "{{route('backend.itemconfig.brand.index') }}",
            rack            : "{{route('backend.itemconfig.rack.index') }}",
            row             : "{{route('backend.itemconfig.row.index') }}",
            category        : "{{route('backend.itemconfig.category.index') }}",
            sub_category    : "{{route('backend.itemconfig.subcategory.index') }}",
            child_category  : "{{route('backend.itemconfig.childcategory.index') }}",
        }
    };
    let table_name;
    $(function () {

        table_name =  $(".item_table").DataTable({
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
            pageLength: 10,
            ajax: {

                url : "{{ route('backend.itemconfig.item.index') }}",
                data : function ( d ) {
                    d.category_id = $('select#category_id').val();
                    d.subcategory_id = $('select#subcategory_id').val();
                    d.childcategory_id = $('select#childcategory_id').val();
                    d.brand_id = $('select#brand_id').val();
                    d.unit_id = $('select#unit_id').val();
                },
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'category_id', name: 'category_id' },
                { data: 'subcategory_id', name: 'subcategory_id' },
                // { data: 'childcategory_id', name: 'childcategory_id' },
                { data: 'sell_price', name: 'sell_price' },
                // { data: 'brand_id', name: 'brand_id' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
        });

        // category data
        $.ajax({
            type: "GET",
            url:config.routes.category,
            dataType: 'JSON',
            data: {
                optionData: true
            },

            success: function(res) {
                $.map(res.data, function(val, i) {
                    var newOption = new Option(val.name, val.id, false, false);
                    $('#category_id').append(newOption).trigger('change');
                });
            }
            , error: function(jqXHR, exception) {
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
            }
        });
        // brand data
        $.ajax({
            type: "GET",
            url:config.routes.brand,
            dataType: 'JSON',
            data: {
                optionData: true
            },

            success: function(res) {
                $.map(res.data, function(val, i) {
                    var newOption = new Option(val.name, val.id, false, false);
                    $('#brand_id').append(newOption).trigger('change');
                });
            }
            , error: function(jqXHR, exception) {
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
            }
        });
        // unit data
        $.ajax({
            type: "GET"
            , url: config.routes.unit
            , dataType: 'JSON'
            , data: {
                optionData: true
            },

            success: function(res) {
                $.map(res.data, function(val, i) {
                    var newOption = new Option(val.name, val.id, false, false);
                    $('#unit_id').append(newOption).trigger('change');
                });
            }
            , error: function(jqXHR, exception) {
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
            }
        });
        // rack data
        $.ajax({
            type: "GET"
            , url: config.routes.rack
            , dataType: 'JSON'
            , data: {
                optionData: true
            },

            success: function(res) {
                $.map(res.data, function(val, i) {
                    var newOption = new Option(val.name, val.id, false, false);
                    $('#rack_id').append(newOption).trigger('change');
                });
            }
            , error: function(jqXHR, exception) {
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
            }
        });
    });

    function dataBaseCall(){
        table_name.ajax.reload();
    }

    // row data
    $('#rack_id').on('click', function(e) {
        e.preventDefault();
        let url = config.routes.row
        $.ajax({
            type: "GET"
            , url: url
            , dataType: 'JSON'
            , data: {
                rack_id: e.target.value
            },

            success: function(res) {
                $("#row_id").html('');
                $.map(res.data, function(val, i) {
                    var newOption = new Option(val.name, val.id, false, false);
                    $('#row_id').append(newOption).trigger('change');
                });
            }
            , error: function(jqXHR, exception) {
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
            }
        , });

    });

    // sub-category data
    $('#category_id').on('click', function(e) {

        e.preventDefault();
        $.ajax({
            type: "GET"
            , url: config.routes.sub_category
            , dataType: 'JSON'
            , data: {
                category_id: e.target.value
            },

            success: function(res) {
                $("#subcategory_id").html('').select2();
                $("#childcategory_id").html('').select2();
                $.map(res.data, function(val, i) {
                    var newOption = new Option(val.name, val.id, false, false);
                    $('#subcategory_id').append(newOption).trigger('change');
                });
                table_name.ajax.reload();
            }
            , error: function(jqXHR, exception) {
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
            }
        , });

    });

    // child-category data
    $('#subcategory_id').on('click', function(e) {

        e.preventDefault();
        let url = "{{route('backend.itemconfig.childcategory.index') }}"
        $.ajax({
            type: "GET"
            , url: config.routes.child_category
            , dataType: 'JSON'
            , data: {
                subcategory_id: e.target.value
            },

            success: function(res) {
                $("#childcategory_id").html(' ').select2();
                $.map(res.data, function(val, i) {
                    var newOption = new Option(val.name, val.id, false, false);
                    $('#childcategory_id').append(newOption).trigger('change');
                });
                table_name.ajax.reload();
            }
            , error: function(jqXHR, exception) {
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
            }
        , });

    });


</script>
@endpush

