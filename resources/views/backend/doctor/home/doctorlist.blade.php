@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@section('page-header')
    <i class="fa fa-list"></i>Doctor List
@stop
@push('css')
@endpush
@section('content')

    @include('backend._partials.page_header', [
        'fa' => 'fa fa-plus-circle',
        'name' => 'Create Doctor',
        'route' => route('backend.doctor.create'),
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
                                    <th class="text-center">Doctor Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Mobile</th>
                                    <th class="text-center">Emergency Number</th>

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
                ajax: "{{ route('backend.doctorlist') }}",
                ajax: {
                    method: 'GET',
                    url: "{{ route('backend.doctorlist') }}",
                    data: function(d) {
                        d.status = $('select#status').val() || true;
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'Doctor',
                        name: 'first_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },

                    {
                        data: 'Emergency',
                        name: 'emergency_number'
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
