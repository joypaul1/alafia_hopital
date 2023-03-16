@extends('backend.layout.app')


@section('page-header')
    <i class="fa fa-list"></i> Permission List
@stop
@section('content')

@include('backend._partials.page_header', [
    'fa' => 'fa fa-plus-circle',
    'name' => 'Create Permission',
    'route' => route('backend.permissions.create')
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
                                <th class="text-center">Module</th>
                                <th class="text-center">Submodule</th>

                                <th class="text-center">Title</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            @forelse ($permissions as $key=>$item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->modules->name ?? '' }}</td> 
                                    <td>{{ $item->submodules->name ?? ''}}</td> 

                                    <td>{{ $item->name ??'-' }}</td> 
                                    <td>
                                    @if(auth('admin')->user()->can('edit-permission'))

                                        <a href="{{ route('backend.permissions.edit', $item) }}" class="btn btn-sm btn-icon btn-warning  m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i>
                                        </a>
                                        @endif
                                        @if(auth('admin')->user()->can('delete-permission'))

                                        <button   type="button"  onclick="delete_check({{$item->id}})"
                                        class="btn btn-sm btn-icon btn-danger  button-remove" data-toggle="tooltip" data-original-title="Remove" aria-describedby="tooltip64483"><i class="icon-trash" aria-hidden="true"></i>
                                        </button >
                                        <form action="{{ route('backend.permissions.destroy', $item)}}"
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

