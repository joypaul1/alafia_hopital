@extends('backend.layout.app')
@push('css')


@endpush

@section('page-header')
<i class="fa fa-list"></i> Patient List
@stop
@section('content')

@include('backend._partials.page_header', [
'fa' => 'fa fa-plus-circle',
'name' => 'Create Patient',
'route' => route('backend.patient.create')
])

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sl.</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">PatientId</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Address</th> 
                                {{-- <th class="text-center">Action</th>  --}}
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($patients as $key=>$patient)
                            <tr class="text-center"> 
                                <td>{{ $key+1 }}</td>
                                <td>{{ $patient->name}}</td>
                                <td>{{ $patient->patientId}}</td>
                                <td>{{ $patient->email}}</td>
                                <td>{{ $patient->mobile}}</td>
                                <td>{{ $patient->address}}</td>

                            </tr>
                            @endforeach



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
    function changeStatus(here) {

        var $id = $(here).data('id');
        // console.log($(here).data('id'),"{{ route('backend.employee.department.show',"+id+") }}" );
        $.get('{{ route("backend.employee.department.show",' + $id + ') }}'
            , function(data, textStatus, jqXHR) {
                console.log(data, textStatus, jqXHR);
            }, 'dataType');
    }

    function delete_check(id) {
        Swal.fire({
            title: 'Are you sure?'
            , html: "<b>You will delete it permanently!</b>"
            , type: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Yes, delete it!'
            , width: 400
        , }).then((result) => {
            if (result.value) {
                $('#deleteCheck_' + id).submit();
            }
        })
    }

</script>


@endpush
