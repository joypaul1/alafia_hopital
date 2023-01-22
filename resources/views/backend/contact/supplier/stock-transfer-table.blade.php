@extends('backend.layout.app')
@include('backend._partials.datatable__delete')


@section('page-header')
<i class="fa fa-plus-circle"></i> Supplier Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Supplier List',
'route' => route('backend.supplier.index')
])

<div class="card border-top">
    <div class="body">
        <h6 class="mb-4"> All Stock Transfers</h6>
        <table ellspacing='0' style="width: 100% !important;" class="table table-bordered text-center dataTable w-full" id="supplier_table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Reference No</th>
                    <th>Location (From)</th>
                    <th>Location (To)</th>
                    <th>Status</th>
                    <th>Shipping Charge</th>
                    <th>Total Amount</th>
                    <th>Additional Notes</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>


@endsection

@push('js')
<script>
    let table_name = $("#supplier_table");
    $(function() {
        table_name.DataTable({
            dom: "Bfrtip",
            buttons: ["colvis", "copy", "csv", "excel", "pdf", "print",
                {
                    text: 'Reload',
                    action: function(e, dt, node, config) {
                        table_name.DataTable().ajax.reload();
                    }
                }
            ],
            processing: true,
            serverSide: true,
            destroy: true,
            pagingType: 'numbers',
            pageLength: 10,
            ajax: "{{ route('backend.supplier.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'mobile',
                    name: 'mobile'
                },
                {
                    data: 'email',
                    name: 'email'
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
</script>
@endpush