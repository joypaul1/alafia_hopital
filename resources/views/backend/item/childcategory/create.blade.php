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
                    <form class="" 
                    action="{{ route('backend.itemconfig.childcategory.store') }}" method="Post" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-row">
                            
                            @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder' => 'name will be here...', 'required'=> 'yes' ])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])

                        </div>

                        <div class="form-row">

                            @include('components.backend.forms.select2.option',[ 'name' => 'category_id', 'label'=> 'Category','optionDatas'=>$categories])
                            @include('components.backend.forms.input.errorMessage', ['message' =>  $errors->first('category_id')])
                          
                        </div>
                        
                        <div class="form-row">
                            @include('components.backend.forms.select2.option',[ 'name' => 'subcategory_id','label'=> 'Subcategory','optionDatas'=>[]])
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
</div>


@endsection

@push('js')


<script>



    $('#category_id').on('change', function(e) {
        e.preventDefault();
        let url ="{{route('backend.itemconfig.subcategory.index') }}"
        $.ajax({
            type: "GET",
            url: url ,
            dataType: 'JSON',
            data:{ category_id:e.target.value},

            success: function (res) {
                $("#subcategory_id").html(' ');
                $.map( res.data, function( val, i ) {
                    var newOption = new Option(val.name, val.id, false, false);
                    $('#subcategory_id').append(newOption).trigger('change');
                
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
   
</script>

@endpush
