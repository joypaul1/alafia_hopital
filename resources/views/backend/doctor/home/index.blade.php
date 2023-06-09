@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@section('page-header')
    <i class="fa fa-list"></i>Doctor Appointment List
@stop
@push('css')
{{-- <link rel="stylesheet" href="https://preview.colorlib.com/theme/bb/bootstrap-buttons-18/css/ionicons.min.css"> --}}
{{-- <link rel="stylesheet" href="https://preview.colorlib.com/theme/bb/bootstrap-buttons-18/css/style.css"> --}}
@endpush
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
                <div class="table-responsive">
                    <table class="table table-bordered text-center dataTable" id="appointment_table">
                        <thead>
                            <tr>
                                <th class="text-center">Sl.</th>
                                <th class="text-center">App. Date</th>
                                <th class="text-center">Invoice No.</th>
                                <th class="text-center">Patient Id</th>
                                <th class="text-center">Patient Name</th>
                                <th class="text-center">Mobile</th>
                                {{-- <th class="text-center"></th> --}}
                                {{-- <th class="text-center">Status</th> --}}
                                <th class="text-center">Actiion</th>
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
                ajax: "{{ route('backend.doctor.index') }}",
                ajax: {
                    method: 'GET',
                    url: "{{ route('backend.doctor.index') }}",
                    data: function(d) {
                        d.status = $('select#status').val() || true;
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'appointment_date',
                        name: 'appointment_date'
                    },
                    {
                        data: 'invoice_number',
                        name: 'invoice_number'
                    },

                    {
                        data: 'p_id',
                        name: 'p_id'
                    },
                    {
                        data: 'patient_id',
                        name: 'patient_id'
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
