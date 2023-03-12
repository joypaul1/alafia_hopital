@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@section('page-header')
    <i class="fa fa-list"></i> Manufacturer List
@stop
@section('content')

@include('backend._partials.page_header', [
    'fa' => 'fa fa-plus-circle',
    'name' => 'Create Manufacturer',
    'route' => route('backend.itemconfig.brand.create')
 ])


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table ellspacing='0' class="table table-bordered text-center dataTable" id="brand_table">
                        <thead>
                            <tr>
                                <th >Sl.</th>
                                <th >Name</th>
                                {{-- <th >Image</th> --}}
                                <th >Action</th>
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
    let table_name =  $("#brand_table");
    $(function () {
        table_name.DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print"],
            processing: true,
            serverSide: true,
            destroy: true,
            pageLength: 10,
            ajax: "{{ route('backend.itemconfig.brand.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                // { data: "image",
                //         render: function (img) {
                //         return '<img src="' + img + '" alt="no-image" height="100px" width="100" >';
                // },  orderable: false, searchable: false},

                { data: 'action', name: 'action', orderable: false, searchable: false },  
            ],
        });
    });

   
</script>
@endpush