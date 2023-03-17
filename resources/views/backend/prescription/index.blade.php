@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@section('page-header')
    <i class="fa fa-list"></i> Presription List
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
                    <table ellspacing='0' class="table table-bordered text-center dataTable" id="prescription_table">
                        <thead>
                            <tr>
                                <th >Sl.</th>
                                <th >Pres. Number</th>
                                <th >Date</th>
                                <th >Patient</th>
                                {{-- <th >Appointment</th> --}}
                                <th >Next Visit</th>
                                <th >Symptoms</th>
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
    let table_name =  $("#prescription_table");
    $(function () {
        table_name.DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print"],
            processing: true,
            serverSide: true,
            destroy: true,
            pageLength: 10,
            ajax: "{{ route('backend.prescription.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'invoice_number', name: 'invoice_number' },
                { data: 'date', name: 'date' },
                { data: 'patient_id', name: 'patient_id' },
                { data: 'next_visit', name: 'next_visit' },
                { data: 'symptoms', name: 'symptoms' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
        });
    });


</script>
@endpush
