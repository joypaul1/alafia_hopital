@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@section('page-header')
    <i class="fa fa-list"></i> Doctor List
@stop
@section('content')

@include('backend._partials.page_header', [
    'fa' => 'fa fa-plus-circle',
    'name' => 'Create Doctor',
    'route' => route('backend.doctor.create')
 ])


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
                    <table class="table table-bordered text-center dataTable" id="category_table">
                        <thead>
                            <tr>
                                <th class="text-center">Sl.</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Department</th>
                                <th class="text-center">Designation</th>
                                <th class="text-center">Image</th>
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



@endsection

@push('js')
    <script>
        $(function() {
        table_name =$("#category_table").DataTable({
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
            ajax: "{{ route('backend.doctor.index') }}",
            ajax: {
                method:'GET',
                url : "{{ route('backend.doctor.index') }}",
                data : function ( d ) {
                    d.status = $('select#status').val()||true;
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                 {
                    data: 'full_name',
                    name: 'full_name'
                },
                {
                    data: 'department_id',
                    name: 'department_id'
                },
                {
                    data: 'designation_id',
                    name: 'designation_id',
                },

                {
                    data: "image",
                    render: function(img) {
                        return '<img src="' + img + '" alt="no-image" height="100px" width="100" >';
                    },
                    orderable: false,
                    searchable: false
                }, {
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
    </script>


@endpush
