@extends('backend.layout.app')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/dropify/css/dropify.min.css">
@endpush
@section('page-header')
<i class="fa fa-plus-circle"></i> Admin Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Admin List',
'route' => route('backend.admin.index')
])


<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="form-validation">
                    <form  action="{{ route('backend.admin.store') }}" method="Post" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="mb-3 row">
                            {{-- <label class="col-lg-4 col-form-label" for="text">Name  <span class="text-danger">*</span></label> --}}
                            <div class="col-lg-8">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder' => 'name will be here...', 'required'=> true ])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('name')])
                            </div>
                        </div>
                        <div class="mb-3 row">
                            {{-- <label class="col-lg-4 col-form-label" for="email">Email  <span class="text-danger">*</span> </label> --}}
                            <div class="col-lg-8">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'email', 'type' =>'email', 'required'=> true, 'placeholder' => 'email will be here...' ])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('email')])
                            </div>
                        </div>
                        <div class="mb-3 row">
                            {{-- <label class="col-lg-4 col-form-label" for="mobile">Mobile  <span class="text-danger">*</span> </label> --}}
                            <div class="col-lg-8">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'mobile', 'required'=> true,'placeholder' => 'mobile will be here (01...)' ])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('mobile')])
                            </div>
                        </div>
                        <div class="mb-3 row">
                            {{-- <label class="col-lg-4 col-form-label" for="password">Password  <span class="text-danger">*</span> </label> --}}
                            <div class="col-lg-8">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'password', 'type' =>'text','required'=> true, 'placeholder' => 'Password will be here...' ])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('password')])
                            </div>
                        </div>

                        <div class="mb-3 row">
                            {{-- <label class="col-lg-4 col-form-label" for="image">Image</label> --}}
                            <div class="col-lg-8">
                                <input type="file" name="image" class="dropify" data-allowed-file-extensions="jpg jpeg png ">

                                <strong class="text-danger text-bold">Image Will be (200x200) px </strong>

                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('image')])
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
</div>


@endsection

@push('js')
 <script src="{{ asset('assets/backend') }}/vendor/dropify/js/dropify.min.js"></script>
 <script src="{{ asset('assets/backend') }}/js/pages/forms/dropify.js"></script>


@endpush
