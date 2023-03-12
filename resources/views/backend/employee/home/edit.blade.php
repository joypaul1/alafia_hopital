@extends('backend.layout.app')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/dropify/css/dropify.min.css">
<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/font-awesome/css/font-awesome.min.css" />
@endpush
@section('page-header')
<i class="fa fa-plus-circle"></i> Slider Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Slider List',
'route' => route('backend.siteConfig.slider.index')
])


<div class="row">
    <div class="col-lg-8">
        <div class="card">

            <div class="card-body">
                <div class="form-validation">
                    <form  action="{{ route('backend.siteConfig.slider.update', $slider) }}" method="Post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3 row">
                            <label class="col-lg-4 col-form-label" for="text">Text </label>
                            <div class="col-lg-8">

                                @include('components.backend.forms.input.input-type',[ 'name' => 'text', 'value' => old('text',$slider->text), 'placeholder' => 'text will be here...' ])

                                @error('text')
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('text')])
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">

                            <label class="col-lg-4 col-form-label" for="position">Position

                            </label>
                            <div class="col-lg-8">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'position', 'value' =>old('position',$slider->position), 'placeholder' => 'position will be here...(1,2,3..)' ])

                                @error('position')
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('position')])
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-4 col-form-label" for="image">Image
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-8">
                                <input type="file" name="image" class="dropify" data-allowed-file-extensions="jpg jpeg png ">

                                <strong class="text-danger text-bold">Image Will be (200x200) px </strong>
                                @error('image')
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('image')])

                                @enderror
                            </div>
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
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Uploaded Document</h4>
            </div>
            <div class="card-body">
                <a href="#"   onClick="javascript:showMyModalImage('{{asset($slider->image)}}')">
                    <img class="card-img-top img-fluid" src="{{asset($slider->image)}}" alt="Current Image">
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Slider Image View</h4>
            </div>
            <div class="modal-body">
                <img src="#" alt="" id="outputImage" width='100%' height="50%">
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
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
