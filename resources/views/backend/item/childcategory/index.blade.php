@extends('backend.layout.app')
@push('css')

<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

@endpush

@section('page-header')
    <i class="fa fa-list"></i> Childcategory List
@stop
@section('content')

@include('backend._partials.page_header', [
    'fa' => 'fa fa-plus-circle',
    'name' => 'Create Childcategory',
    'route' => route('backend.itemconfig.childcategory.create')
 ])

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table
                       
                        class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sl.</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Slug</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            @forelse ($childcategories as $key=>$item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->name??'-' }}</td>
                                    <td>{{ $item->slug??'-' }}</td>
                                    <td><img src="{{ asset( $item->image) }}" alt="{{ $item->image }}" srcset="" width="100%" height="100"></td>
                                    <td>
                                        
                                        @include('components.backend.forms.input.input-switch', ['status' => $item->status ])

                                    </td>
                                    <td>
                                        <a href="{{ route('backend.itemconfig.childcategory.edit', $item) }}" class="btn btn-sm btn-icon btn-warning  m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i>
                                        </a>
                                        <button   type="button" 
                                        onclick="delete_check({{$item->id}})"
                                        class="btn btn-sm btn-icon btn-danger  button-remove" data-toggle="tooltip" data-original-title="Remove" aria-describedby="tooltip64483"><i class="icon-trash" aria-hidden="true"></i>
                                        </button >
                                        <form action="{{ route('backend.itemconfig.childcategory.destroy', $item)}}"
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
        
    </script>

    
@endpush