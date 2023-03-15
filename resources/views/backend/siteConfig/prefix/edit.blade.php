@extends('backend.layout.app')

@section('page-header')
<i class="fa fa-plus-circle"></i> Banner Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Banner List',
'route' => route('backend.siteConfig.banner.index')
])


<div class="row">
    <div class="col-lg-8">
        <div class="card">

            <div class="card-body">
                <div class="form-validation">
                    <form class="needs-validation" action="{{ route('backend.siteConfig.banner.update', $banner) }}" method="Post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'position', 'value' =>old('position',$banner->position), 'placeholder' => 'position will be here...(1,2,3..)' ])
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
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Uploaded Document</h4>
            </div>
            <div class="card-body">
                <a href="#"   onClick="javascript:showMyModalImage('{{asset($banner->image)}}')">
                    <img class="card-img-top img-fluid" src="{{asset($banner->image)}}" alt="Current Image">
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Banner Image View</h4>
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

<script>
    function showMyModalImage(imgsrc) {
        $("#outputImage").attr("src", imgsrc);
        $('#defaultModal').modal('show');
    }
</script>



@endpush
