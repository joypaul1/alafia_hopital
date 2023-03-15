@extends('backend.layout.app')

@section('content')
@push('css')



@endpush
{{-- @section('page-header')
<i class="fa fa-info-circle"></i> Company Setting Information
@stop --}}

@section('content')
{{-- @include('backend._partials.page_header', [
'fa' => 'fa fa-info-circle',
]) --}}

<form class="needs-validation" action="{{ route('backend.siteConfig.socialmedia.store') }}" method="Post" enctype="multipart/form-data">
    @method('POST')
    @csrf
    <div class="card">
        <div class="card-body">
            <h6>
                Any Social Media Links
                <hr>
            </h6>
            <div class="form-validation">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" value="{{old('facebook', $socialmedia->facebook) }}" name="facebook" placeholder="Enter Facebook URL" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-twitter-square" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" value="{{old('twitter', $socialmedia->twitter) }}" name="twitter" placeholder="Enter Twitter URL" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-youtube-square" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" value="{{old('youtube', $socialmedia->youtube) }}"name="youtube" placeholder="Enter Youtube URL" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-pinterest-square" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" value="{{old('pinterest', $socialmedia->pinterest) }}" name="pinterest" placeholder="Enter Pinterest URL" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    {{-- <div class="col-md-4 col-lg-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-behance-square" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="behance" placeholder="Enter Behance URL" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div> --}}
                    <div class="col-md-4 col-lg-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" value="{{old('linkedin', $socialmedia->linkedin) }}" name="linkedin" placeholder="Enter Linkedin URL" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="number" value="{{old('instagram', $socialmedia->instagram) }}"  class="form-control" name="instagram" placeholder="Enter WhatsApp Number">
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group">
                @include('components.backend.forms.input.submit-button')
            </div>
        </div>
    </div>
</form>

@endsection





