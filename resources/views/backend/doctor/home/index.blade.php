@extends('backend.layout.app')
@push('css')

@endpush

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
                <div class="table-responsive">

                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('js')


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

    <script>
        function delete_check(id) {
            Swal.fire({
                title: 'Are you sure?',
                html: "<b>You will delete it permanently!</b>",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                width: 400,
            }).then((result) => {
                if (result.value) {
                    $('#deleteCheck_' + id).submit();
                }
            })
        }
        // $(function () {

        //     $(".js-exportable").DataTable({
        //         dom: "Bfrtip",
        //         buttons: ["copy", "csv", "excel", "pdf", "print"],
        //         order: [[0, 'desc']],
        //         // processing: true,
        //         // serverSide: true,

        //     });
        // });
    </script>


@endpush
