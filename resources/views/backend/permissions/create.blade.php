@extends('backend.layout.app')

@section('page-header')
<i class="fa fa-plus-circle"></i> Permissions Create
@stop

@section('content')
@if(auth('admin')->user()->can('view-permission'))

@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Permissions List',
'route' => route('backend.permissions.index')
])
@else
@include('backend._partials.page_header')
@endif


<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="form-validation">
                    <form action="{{ route('backend.permissions.store') }}" method="Post"
                        enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                        <select name="module_id" class="form-control show-tick ms select2" id="select2" required>
                                    <option value="">--Select Module--</option>
                                    @foreach($modules as $module)

                                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                                    @endforeach
                                    

                                    </select>
                        </div>
                        <div class="form-group">
                        <select name="submodule_id" class="form-control show-tick ms select2" id="select2" required>
                                    <option value="">--Select SubModule--</option>
                                    @foreach($submodules as $submodule)

                                        <option value="{{ $submodule->id }}">{{ $submodule->name }}</option>
                                        @endforeach                                    

                                    </select>
                        </div>

                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder' =>'Create SubModuleName...' ])
                            @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('title')])
                        </div> 
                         

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