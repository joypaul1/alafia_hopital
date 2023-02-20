@extends('backend.layout.app')

@section('page-header')
<i class="fa fa-plus-circle"></i> Submodules Create
@stop

@section('content')
@if(auth('admin')->user()->can('view-submodule'))

@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Submodules List',
'route' => route('backend.submodules.index')
])

 @else
 @include('backend._partials.page_header')


 @endif



<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="form-validation">
                    <form action="{{ route('backend.submodules.store') }}" method="Post"
                        enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                        <select name="module_id" class="form-control show-tick ms select2" id="select2" required>
                                    <option value="">--Select Module--</option>
                                    @foreach($modules as $mod)
                                    <option value="{{ $mod->id }}">{{ $mod->name }}</option>
                                    @endforeach
                            

                                    </select>
                        </div>

                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder' =>'text will be here...' ])
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