@extends('backend.layout.app')
@push('css')


<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

{{-- <link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
    href="{{ asset('assets/backend') }}/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet"
         href="{{ asset('assets/backend') }}/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css"> --}}
@endpush

@section('page-header')
    <i class="fa fa-list"></i> Slider List
@stop
@section('content')

@include('backend._partials.page_header', [
    'fa' => 'fa fa-plus-circle',
    'name' => 'Create Slider',
    'route' => route('backend.siteconfig.slider.create')
 ])


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table
                        {{-- class="table table-bordered table-striped table-hover dataTable js-exportable"> --}}
                        class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sl.</th>
                                <th class="text-center">Text</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Position</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            @forelse ($employees as $key=>$item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->text??'-' }}</td>
                                    <td><img src="{{ asset( $item->image) }}" alt="{{ $item->image }}" srcset="" width="100%" height="100"></td>
                                    <td>{{ $item->position??'-'}}</td>
                                    <td>
                                        <a href="{{ route('backend.siteconfig.slider.edit', $item) }}" class="btn btn-sm btn-icon btn-warning  m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i>
                                        </a>
                                        <button   type="button"  onclick="delete_check({{$item->id}})"
                                        class="btn btn-sm btn-icon btn-danger  button-remove" data-toggle="tooltip" data-original-title="Remove" aria-describedby="tooltip64483"><i class="icon-trash" aria-hidden="true"></i>
                                        </button >
                                        <form action="{{ route('backend.siteconfig.slider.destroy', $item)}}"
                                            id="deleteCheck_{{ $item->id }}" method="POST">
                                            @method('delete')
                                          @csrf
                                      </form>
                                    </td>
                                </tr>
                            @empty
                                
                            @endforelse
                       
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('js')

   
    <!-- Datatable -->

    {{-- <script src="{{ asset('assets/backend') }}/bundles/libscripts.bundle.js"></script>
    <script src="{{ asset('assets/backend') }}/bundles/vendorscripts.bundle.js"></script>
    <script src="{{ asset('assets/backend') }}/bundles/datatablescripts.bundle.js"></script>
    <script src="{{ asset('assets/backend') }}/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets/backend') }}/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('assets/backend') }}/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
    <script src="{{ asset('assets/backend') }}/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
    <script src="{{ asset('assets/backend') }}/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
    <script src="{{ asset('assets/backend') }}/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="{{ asset('assets/backend') }}/bundles/mainscripts.bundle.js"></script>
    <script src="{{ asset('assets/backend') }}/js/pages/tables/jquery-datatable.js"></script> --}}
    {{-- <script src="{{ asset('assets/backend') }}/vendor/sweetalert/sweetalert.min.js"></script>  --}}
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