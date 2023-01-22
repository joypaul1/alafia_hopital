@extends('backend.layout.app')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/dropify/css/dropify.min.css">
@endpush
@section('page-header')
<i class="fa fa-plus-circle"></i> Email Config
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => ' ',
'route' => route('backend.siteconfig.email-configuration.index')
])


<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="form-validation">
                    <form action="{{ route('backend.siteconfig.email-configuration.store') }}" method="Post" enctype="multipart/form-data">
                        @method('POST')
                        @csrf

                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'driver', 'placeholder' => 'driver name will be here...', 'value' => $emailConfig->driver??old('driver') ])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('driver')])
                        </div>

                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'host', 'placeholder' => 'host will be here...','value' => $emailConfig->host??old('host') ])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('host')])
                        </div>

                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'port', 'placeholder' => 'port will be here...' , 'value' => $emailConfig->port??old('port')])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('port')])
                        </div>

                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'encryption', 'placeholder' => 'encryption will be here...','value' => $emailConfig->encryption??old('encryption') ])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('encryption')])
                        </div>


                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'user_name', 'placeholder' => 'email user name...' ,'value' => $emailConfig->user_name??old('user_name')])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('user_name')])
                        </div>

                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'password', 'placeholder' => 'email user name...', 'value' => $emailConfig->password??old('password') ])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('password')])
                        </div>

                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'sender_name', 'placeholder' => 'sender name...','value' => $emailConfig->sender_name??old('sender_name') ])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('sender_name')])
                        </div>


                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'sender_email', 'placeholder' => 'sender email...' , 'value' => $emailConfig->sender_email??old('sender_email')])
                            @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('sender_email')])
                        </div>


                        <div class="form-group">
                            <label class="col-lg-4 col-form-label" for="image">Any Related Document for Email
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-8">
                                <input type="file" name="document" class="dropify" data-allowed-file-extensions="jpg jpeg png pdf">

                                {{-- <strong class="text-danger text-bold">Image Will be (200x200) px </strong> --}}
                                @error('document')
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('document')])
                                @enderror
                            </div>
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
                <img class="card-img-top img-fluid" src="{{ asset($emailConfig->document??' ') }}" id="outputImage" alt="Current document">
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')
<!-- dropify -->
<script src="{{ asset('assets/backend') }}/vendor/dropify/js/dropify.min.js"></script>
<script src="{{ asset('assets/backend') }}/js/pages/forms/dropify.js"></script>
@endpush
