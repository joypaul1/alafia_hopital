@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@section('page-header')
    <i class="fa fa-list"></i>Medicine Type List
@stop
@section('content')

@include('backend._partials.page_header', [
    'fa' => 'fa fa-plus-circle',
    'name' => 'Create Type',
    'route' => route('backend.itemconfig.type.create')
 ])


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table ellspacing='0' class="table table-bordered text-center dataTable type_table">
                        <thead>
                            <tr>
                                <th> Sl.</th>
                                <th> Name</th>
                                <th> Note</th>
                                <th> Status</th>
                                <th> Action</th>
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
    let table_name =  $(".type_table");
    $(function () {
        table_name.DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print"],
            processing: true,
            serverSide: true,
            destroy: true,
            pageLength: 10,
            ajax: "{{ route('backend.itemconfig.type.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'note', name: 'note' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },  
            ],
        });
    });

   
</script>
@endpush