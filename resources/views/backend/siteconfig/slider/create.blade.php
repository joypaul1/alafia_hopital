@extends('backend.layout.app')

@section('page-header')
<i class="fa fa-plus-circle"></i> Slider Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Slider List',
'route' => route('backend.siteconfig.slider.index')
])


<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="form-validation">
                    <form action="{{ route('backend.siteconfig.slider.store') }}" method="Post"
                        enctype="multipart/form-data">
                        @method('POST')
                        @csrf

                        {{-- <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'text', 'placeholder' =>'text will be here...' ])
                            @include('components.backend.forms.input.errorMessage', ['message'=>$errors->first('text')])
                        </div> --}}

                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'position', 'number'=>true, 'placeholder'=> 'position will be here...(1,2,3..)' ])
                            @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('position')])
                        </div>

                        <div class="form-group">
                            @include('components.backend.forms.input.input-image',[ 'name' => 'image', 'alert_text' =>'Image Will be (200x200)px.' ])
                            @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('image')])
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