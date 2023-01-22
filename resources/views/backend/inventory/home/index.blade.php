
@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@section('page-header')
    <i class="fa fa-list"></i> Inventory Item List
@stop

@section('table_header')
@include('backend._partials.page_header', [
    // 'fa' => 'fa fa-plus-circle',
    // 'name' => 'Create Warehouse',
    // 'modelName' => 'create_data',
    // 'route' => '#'
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
                                @include('components.backend.forms.select2.option',[ 'label'=> 'warehouse',  'name' => 'warehouses_id','onclick'=>true , 'optionDatas' => $warehouses ])
                            </div>
                        </div>
                        {{-- <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                @include('components.backend.forms.select2.option',[ 'label'=> 'status', 'name' => 'status','onchange'=>true,  'optionDatas' => $status ])
                            </div>
                        </div> --}}
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
                                <th class="text-center">Date</th>
                                <th class="text-center">WareHouse</th>
                                <th class="text-center">Item Name</th>
                                <th class="text-center">Purchase Qty</th>
                                <th class="text-center">Purchase Return Qty</th>
                                <th class="text-center">sell Qty</th>
                                <th class="text-center">sell Return Qty</th>
                                <th class="text-center">Sell Replacement Qty</th>
                                <th class="text-center">Damage Qty</th>
                                <th class="text-center">Available Qty</th>
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
                url : "{{ route('backend.inventory.inventoryitem.index') }}",
                data : function ( d ) {
                    d.warehouses_id = $('select#warehouses_id').val();
                    // d.status = $('select#status').val()||true;
                },
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'date', name: 'date'},  
                { data: 'warehouses_id', name: 'warehouses_id' },
                { data: 'item_id', name: 'item_id' },
                { data: 'pur_qty', name: 'pur_qty' },
                { data: 'pur_return_qty', name: 'pur_return_qty' },
                { data: 'sell_qty', name: 'sell_qty' },
                { data: 'sell_return_qty', name: 'sell_return_qty' },
                { data: 'sell_replacement_qty', name: 'sell_replacement_qty' },
                { data: 'damage_qty', name: 'damage_qty' },
                { data: 'available_qty', name: 'available_qty' },
                
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
   

    
</script>
@endpush

