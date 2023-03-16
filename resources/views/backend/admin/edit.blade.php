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
                    <form  action="{{ route('backend.admin.update', $admin) }}" method="Post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3 row">
                            {{-- <label class="col-lg-4 col-form-label" for="name">Name   <span class="text-danger">*</span> </label> --}}
                            <div class="col-lg-8">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'value' => old('name',$admin->name), 'placeholder' => 'name will be here...' , 'required'=> true,])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                            </div>
                        </div>
                        <div class="mb-3 row">
                            {{-- <label class="col-lg-4 col-form-label" for="email">Email   <span class="text-danger">*</span> </label> --}}
                            <div class="col-lg-8">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'email', 'type' =>'email', 'required'=> true, 'value' => old('email', $admin->email), 'placeholder' => 'email will be here...' ])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('email')])
                            </div>
                        </div>
                        <div class="mb-3 row">
                            {{-- <label class="col-lg-4 col-form-label" for="mobile">Mobile  <span class="text-danger">*</span> </label> --}}
                            <div class="col-lg-8">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'mobile', 'required'=> true, 'value' => old('mobile', $admin->mobile), 'placeholder' => 'mobile will be here (01...)' ])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('mobile')])
                            </div>
                        </div>
                        <div class="mb-3 row">
                            {{-- <label class="col-lg-4 col-form-label" for="password">Password  <span class="text-danger">*</span> </label> --}}
                            <div class="col-lg-8">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'password', 'type' =>'text', 'placeholder' => 'Password will be here...' ])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('password')])
                            </div>
                        </div>

                        <div class="mb-3 row">
                            {{-- <label class="col-lg-4 col-form-label" for="image">Image </label> --}}
                            <div class="col-lg-8">
                                <input type="file" name="image" class="dropify" data-allowed-file-extensions="jpg jpeg png ">
                                <strong class="text-danger text-bold">Image Will be (200x200) px </strong>
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('image')])
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-lg-8">
                            <select name="role_id" class="form-control show-tick ms select2" id="select2" required>
                                    <option value="">--Select Role--</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @if($role->id == $userrole->role_id) selected @endif>{{ $role->name }}</option>
                                    @endforeach
                                    </select>
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
                <a href="#"   onClick="javascript:showMyModalImage('{{asset($admin->image)}}')">
                    <img class="card-img-top img-fluid" src="{{asset($admin->image)}}" alt="Current Image">
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Admin Image View</h4>
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
