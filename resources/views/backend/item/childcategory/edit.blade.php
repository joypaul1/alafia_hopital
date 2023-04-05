@extends('backend.layout.app')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/select2/select2.css" />
<link rel="stylesheet" href="{{ asset('assets/backend') }}/css/main.css">
<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/dropify/css/dropify.min.css">
@endpush
@section('page-header')
<i class="fa fa-plus-circle"></i> Childcategory Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Childcategory List',
'route' => route('backend.itemconfig.childcategory.index')
])


<div class="row">
    <div class="col-lg-8">
        <div class="card">

            <div class="card-body">
                <div class="form-validation">
                    <form class="needs-validation" action="{{ route('backend.itemconfig.childcategory.update', $childcategory) }}" method="Post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        {{-- <div class="mb-3 row">
                            <div class="col-lg-8">

                                @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'value' => old('name',$childcategory->name), 'placeholder' => 'text will be here...' ])

                                @error('name')
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                @enderror
                            </div>
                        </div> --}}
                        <div class="form-row">

                            @include('components.backend.forms.input.input-type',[ 'name' => 'name','value' => old('name',$childcategory->name), 'placeholder' => 'name will be here...', 'required'=> 'yes' ])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])

                        </div>

                        <div class="form-row">

                            @include('components.backend.forms.select2.option',[ 'name' => 'category_id','selectedKey' =>$childcategory->category_id, 'label'=> 'Category','optionData'=>$categories])
                            @include('components.backend.forms.input.errorMessage', ['message' =>  $errors->first('category_id')])

                        </div>

                        <div class="form-row">
                            @include('components.backend.forms.select2.option',[ 'name' => 'subcategory_id','label'=> 'Subcategory', 'selectedKey' =>$childcategory->subcategory_id,'optionData'=>$subcategories])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('subcategory_id')])
                        </div>



                        <div class="form-row">

                            @include('components.backend.forms.input.input-image', ['name' => 'image'])
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
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Uploaded Document</h4>
            </div>
            <div class="card-body">
                <a href="#"   onClick="javascript:showMyModalImage('{{asset($childcategory->image)}}')">
                    <img class="card-img-top img-fluid" src="{{asset($childcategory->image)}}" alt="Current Image">
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Childcategory Image View</h4>
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
<script src="{{ asset('assets/backend') }}/vendor/select2/select2.min.js"></script>
<script src="{{ asset('assets/backend') }}/js/pages/forms/advanced-form-elements.js"></script>
<script src="{{ asset('assets/backend') }}/vendor/dropify/js/dropify.min.js"></script>
<script src="{{ asset('assets/backend') }}/js/pages/forms/dropify.js"></script>
<script>
    $("#category_id").select2();

    $("#subcategory_id").select2();

    $('#category_id').on('change', function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "{{url('admin/subcategory')}}",
            dataType: 'JSON',
            data:{ category_id:e.target.value},

            success: function (res) {

                $.map( res.data, function( val, i ) {
                    console.log(val);
                    var option = new Option(val.name, val.id);
                    option.selected = true;
                    $("#subcategory_id").html(' ');
                    $("#subcategory_id").append(option).trigger("change");

                });
            },
            error: function (jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                console.log(msg);
            },
        });

    });

    function showMyModalImage(imgsrc) {
        $("#outputImage").attr("src", imgsrc);
        $('#defaultModal').modal('show');
    }
</script>



@endpush
