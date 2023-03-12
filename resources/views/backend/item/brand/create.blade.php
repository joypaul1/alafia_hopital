@extends('backend.layout.app')

@section('page-header')
<i class="fa fa-plus-circle"></i> Manufacturer Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Manufacturer List',
'route' => route('backend.itemconfig.brand.index')
])
  

<div class="row">
    <div class="col-lg-8">
        <div class="card">
           
            <div class="card-body">
                <div class="form-validation">
                    <form  action="{{ route('backend.itemconfig.brand.store') }}" method="Post" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-row">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder' => 'name will be here...', 'required'=> true ])
                            @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('name')])
                        </div>
                       
                     
                        <div class="my-3 row">
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


