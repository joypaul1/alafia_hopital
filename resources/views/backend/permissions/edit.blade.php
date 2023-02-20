@extends('backend.layout.app')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/dropify/css/dropify.min.css">
<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/font-awesome/css/font-awesome.min.css" />
@endpush
@section('page-header')
<i class="fa fa-plus-circle"></i> Permission Update
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
                    <form  action="{{ route('backend.permissions.update', $permission) }}" method="Post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'value' => old('title',$permission->name), 'placeholder' => 'text will be here...' ])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('title')])
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
   

@endsection

@push('js')
<script src="{{ asset('assets/backend') }}/vendor/dropify/js/dropify.min.js"></script>
<script src="{{ asset('assets/backend') }}/js/pages/forms/dropify.js"></script>
<script>
    function showMyModalImage(imgsrc) {
        $("#outputImage").attr("src", imgsrc);
        $('#defaultModal').modal('show');
    }
</script>



@endpush
