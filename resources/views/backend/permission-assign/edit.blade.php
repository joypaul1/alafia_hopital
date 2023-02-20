@extends('backend.layout.app')

@section('page-header')
<i class="fa fa-plus-circle"></i> Permissions Assign 
@stop

@section('content')
@if(auth('admin')->user()->can('view-access-control'))

@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Permissions Assigned List',
'route' => route('backend.permission-assign.index')
])
@else
@include('backend._partials.page_header')

@endif


<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="form-validation">
                <form  action="{{ route('backend.permission-assign.store') }}" method="Post" enctype="multipart/form-data">
                        @method('POST')
                        @csrf

                        <div class="mb-3 row">
                            <div class="col-lg-8">
                            <label>Role</label>
                            <input type="hidden" name="id" value="{{ $id }}" />
                           
                            <select name="role_id" class="form-control show-tick ms select2" id="select2" required>
                                    <option value="">--Select Role--</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @if($role->id == $id) selected @endif>{{ $role->name }}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                        <div>
                        <label>Permissions:</label>

                        </div>
                        @foreach($modules as $module)
                        <label>{{ $module->name }}</label>

                        <div class="mb-3 row">
                        @foreach($module->submodules as $submodule)
                        <div class="mb-3 row">

                        <div class="col-lg-4" style="width:300px;">
                            <label>{{ $submodule->name }}</label>
                            
                        </div>

                        
                            <div class="col-lg-8">
                            @foreach ($submodule->permissions as $permission)
                        <label class="checkbox_label col-md-6" for="permission_no_{{ $permission->id }}" style=""> 
                            <input type="checkbox" name="permissions[]" id="permission_no_{{ $permission->id }}" value="{{ $permission->id }}" {{ in_array($permission->id,$permarray) ? "checked" :'' }}  >
                            <span class="checkmark"></span>
                            {{ $permission->name }}
                        </label>
                        @endforeach 
                                
                            </div>
                        </div>
                            @endforeach
                        </div>
                      
                      @endforeach

                        <div class="form-group">
                            @include('components.backend.forms.input.submit-button')
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection