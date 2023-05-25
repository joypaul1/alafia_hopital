@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@section('page-header')
    <i class="fa fa-list"></i>Employee List
@stop
@push('css')
@endpush
@section('content')

    @include('backend._partials.page_header', [
        'fa' => 'fa fa-plus-circle',
        'name' => 'Create Employee',
        'route' => route('backend.employee.create'),
    ])


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center dataTable" id="appointment_table">
                            <thead>
                                <tr>
                                    <th class="text-center">Sl.</th>
                                    <th class="text-center">Employee Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Mobile</th>
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
            table_name = $("#appointment_table").DataTable({
                dom: "Bfrtip",
                buttons: ["colvis", "copy", "csv", "excel", "pdf", "print",
                    {
                        text: 'Reload',
                        action: function(e, dt, node, config) {
                            dataBaseCall();
                        }
                    }
                ],
                processing: true,
                serverSide: true,
                destroy: true,
                pagingType: 'numbers',
                pageLength: 10,
                ajax: "{{ route('backend.employee.index') }}",
                ajax: {
                    method: 'GET',
                    url: "{{ route('backend.employee.index') }}",
                    data: function(d) {
                        d.status = $('select#status').val() || true;
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'Employee',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },

                    



                    // {
                    //     data: 'appointment_status',
                    //     name: 'appointment_status',
                    //     orderable: false,
                    //     searchable: false
                    // },
                    // {
                    //     data: 'doctor_fee',
                    //     name: 'doctor_fee'
                    // },
                    // {
                    //     data: 'paymentHistories',
                    //     name: 'paymentHistories'
                    // },
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
