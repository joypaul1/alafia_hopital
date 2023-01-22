@extends('backend.layout.app')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/dropify/css/dropify.min.css">
@endpush
@section('page-header')
<i class="fa fa-plus-circle"></i> Brand Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Brand List',
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
                        <div class="form-row">
                            @include('components.backend.forms.input.input-image',[ 'name' => 'image', 'alert_text' =>'Image Will be (200x200)px.' ])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('image')])
                        </div>
                     
                        <div class="mb-3 row">
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

@push('js')
 <script src="{{ asset('assets/backend') }}/vendor/dropify/js/dropify.min.js"></script>
 <script src="{{ asset('assets/backend') }}/js/pages/forms/dropify.js"></script>
@endpush
