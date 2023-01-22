@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@section('page-header')
    <i class="fa fa-list"></i> Supplier Ledger List
@stop

@section('table_header')
@include('backend._partials.page_header', [
    // 'fa' => 'fa fa-plus-circle',
    // 'name' => 'Create Supplier',
    // 'modelName' => 'create_data',
    // 'route' => route('backend.supplier.create')
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
                                @include('components.backend.forms.select2.option',[ 'label'=> 'supplier', 'name' => 'supplier_id','onchange'=>true,  'optionDatas' => $suppliers ])
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
                    <table ellspacing='0' class="table table-bordered text-right dataTable" id="supplier_table">
                        <thead>
                            <tr>
                                <th class="text-center" >Sl.</th>
                                <th class="text-center" >Name</th>
                                <th class="text-center" >Debit</th>
                                <th class="text-center" >Credit</th>
                                <th class="text-center" >Amount</th>
                                {{-- <th >Action</th> --}}
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
                url : "{{ route('backend.report.supplierledgerReport') }}",
                data : function ( d ) {
                    d.supplier_id = $('select#supplier_id').val()||true;
                },
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'debit', name: 'debit' },
                { data: 'credit', name: 'credit' },
                { data: 'amount', name: 'amount' },
                // { data: 'action', name: 'action', orderable: false, searchable: false },
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

