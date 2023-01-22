@extends('backend.layout.app')

@section('page-header')
<i class="fa fa-plus-circle"></i> Banner Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Banner List',
'route' => route('backend.siteconfig.banner.index')
])
  

<div class="row">
    <div class="col-lg-8">
        <div class="card">
           
            <div class="card-body">
                <div class="form-validation">
                    <form class="needs-validation" action="{{ route('backend.siteconfig.banner.store') }}" method="Post" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                     
                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'position', 'placeholder' => 'position will be here...(1,2,3..)' ])
                            @include('components.backend.forms.input.errorMessage', ['message' =>   $errors->first('position')]) 
                        </div>
                     
                        <div class="form-group">
                            @include('components.backend.forms.input.input-image',[ 'name' => 'image', 'alert_text' =>'Image Will be (200x200)px ' ])
                            @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('image')])
                        </div>
                     
                        <div class="form-group">
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


@endpush
