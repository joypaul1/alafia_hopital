@extends('backend.layout.app')
@include('backend._partials.datatable__delete')
@push('css')

@endpush

@section('page-header')
<i class="fa fa-list"></i> Order Delivered List
@stop

@section('table_header')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
// 'name' => 'Create Order',
// 'modelName' => 'create_data',
'route' => route('backend.order.order-list.index')
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
                    <table class="table table-bordered text-center dataTable" id="Order_table">
                        <thead>
                            <tr>
                                <th class="text-center">Sl.</th>
                                <th class="text-center">Customer </th>
                                <th class="text-center">Order Type</th>
                                <th class="text-center">Item Qty</th>
                                <th class="text-center">Vat</th>
                                <th class="text-center">Sub Total</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Created By</th>
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

<div class="modal fade Order_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg"" role=" document">

    </div>
</div>
@endsection

@push('js')

<script>
    let table_name ;
    var modal = ".Order_modal";
    $(function() {
        table_name =$("#Order_table").DataTable({
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
            pageLength: 20,
            ajax: {
                method:'GET',
                url : "{{ route('backend.order.order-list-delivered.index') }}",
                data : function ( d ) {
                    d.status = $('select#status').val()||true;
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'user',
                    name: 'user'
                },
                {
                    data: 'order_type',
                    name: 'order_type'
                },
                {
                    data: 'item_qty',
                    name: 'item_qty'
                },
                {
                    data: 'vat',
                    name: 'vat'
                },
                {
                    data: 'sub_total',
                    name: 'sub_total'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                {
                    data: 'created_by',
                    name: 'created_by',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
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
