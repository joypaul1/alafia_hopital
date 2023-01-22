@extends('backend.layout.app')
@push('css')
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
@endpush

@section('page-header')
    <i class="fa fa-list"></i> User List
@stop
@section('content')

@include('backend._partials.page_header', [
    'fa' => 'fa fa-plus',
    'name' => 'Create User',
    'route' => route('backend.user.create'),


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
                                <th class="text-center">Email</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($users as $key=>$user)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->name??'-' }}</td>
                                    <td>{{ $user->email??'-' }}</td>

                                    <td>
                                    <a href="{{ route('backend.user.show', $user) }}" class="btn btn-sm btn-icon btn-success  m-r-5" data-toggle="tooltip" data-original-title="View"><i class="icon-eye" aria-hidden="true"></i></a>
                                    <a href="{{ route('backend.user.edit', $user) }}" class="btn btn-sm btn-icon btn-warning  m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></a>

                                    {{-- <a href="{{ route('backend.folder.index', ['user_id' => $user]) }}" class="btn btn-sm btn-icon btn-info  m-r-5" data-toggle="tooltip" data-original-title="View"><i class="fa fa-folder-open" aria-hidden="true"></i></a> --}}

                                        <button   type="button"  onclick="delete_check({{$user->id}})"
                                        class="btn btn-sm btn-icon btn-danger  button-remove" data-toggle="tooltip" data-original-title="Remove" aria-describedby="tooltip64483"><i class="icon-trash" aria-hidden="true"></i>
                                        </button >
                                        <form action="{{ route('backend.user.destroy', $user)}}"
                                            id="deleteCheck_{{ $user->id }}" method="POST">
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
@include('backend._partials.delete_alert')

