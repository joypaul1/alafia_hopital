@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@section('page-header')
    <i class="fa fa-list"></i> Appointment List
@stop
@section('content')

@include('backend._partials.page_header', [
    'fa' => 'fa fa-plus-circle',
    'name' => 'Create Prescription',
    'route' => route('backend.prescription.create')
 ])


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table ellspacing='0' class="table table-bordered text-center dataTable" id="production_table">
                        <thead>
                            <tr>
                                <th >Sl.</th>
                                <th >Date</th>
                                <th >Name</th>
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
    let table_name =  $("#production_table");
    // $(function () {
    //     table_name.DataTable({
    //         dom: "Bfrtip",
    //         buttons: ["copy", "csv", "excel", "pdf", "print"],
    //         processing: true,
    //         serverSide: true,
    //         destroy: true,
    //         pageLength: 10,
    //         ajax: "{{ route('backend.appointment.index') }}",
    //         columns: [
    //             { data: 'DT_RowIndex', name: 'DT_RowIndex' },
    //             { data: 'date', name: 'date' },
    //             { data: 'name', name: 'name' },
    //             { data: 'approximate_sell', name: 'approximate_sell' },
    //             { data: 'approximate_cost', name: 'approximate_cost' },
    //             { data: 'approximate_profit', name: 'approximate_profit' },
    //             { data: 'action', name: 'action', orderable: false, searchable: false },
    //         ],
    //     });
    // });


</script>
@endpush
