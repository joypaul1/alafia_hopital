@extends('backend.layout.app')


@section('page-header')
    <i class="fa fa-list"></i> Permission Assign List
@stop
@section('content')
@if(auth('admin')->user()->can('create-access-control'))

@include('backend._partials.page_header', [
    'fa' => 'fa fa-plus-circle',
    'name' => 'Assign Permission',
    'route' => route('backend.permission-assign.create')
 ])

 @else
 @include('backend._partials.page_header')
@endif

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
                                <th class="text-center">Roles</th>
                                <th class="text-center">Permissions</th>
                                <th class="text-center">Users</th>

                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            @forelse ($roles as $item)
                                <tr>
                                    <td>{{ 1 }}</td>
                                    <td>{{ $item->name ??'-' }}</td> 
                                    <td>
                                        @foreach($item->permissions as $permission)
           <button class="btn btn-sm btn-success"><span style="font-size:10px;"> {{$permission->name}} </span></button>
        @endforeach 
    </td> 
                                    <td>@foreach($item->users as $user)
                                    <button class="btn btn-sm btn-info"><span style="font-size:10px;"> {{$user->name}} </span> </button>
        @endforeach </td> 

                                    <td>
                                    @if(auth('admin')->user()->can('edit-access-control'))

                                    <a href="{{ route('backend.permission-assign.edit', $item) }}" class="btn btn-sm btn-icon btn-warning  m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i>
                                        </a>

                                        @endif
                                    @if(auth('admin')->user()->can('delete-access-control'))
  
                                        <button   type="button"  onclick="delete_check({{$item->id}})"
                                        class="btn btn-sm btn-icon btn-danger  button-remove" data-toggle="tooltip" data-original-title="Remove" aria-describedby="tooltip64483"><i class="icon-trash" aria-hidden="true"></i>
                                        </button >
                                        <form action="{{ route('backend.permission-assign.destroy', $item)}}"
                                            id="deleteCheck_{{ $item->id }}" method="POST">
                                            @method('delete')
                                          @csrf
                                      </form>
                                      @endif
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

