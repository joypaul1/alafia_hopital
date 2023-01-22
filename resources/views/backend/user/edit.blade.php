@extends('backend.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/dropify/css/dropify.min.css">
@endpush
@section('page-header')
    <i class="fa fa-plus"></i> User Create
@stop

@section('content')
    @include('backend._partials.page_header', [
        'fa' => 'fa fa-list',
        'name' => 'User List',
        'route' => route('backend.user.index'),
    ])


    <div class="row">
        <div class="col-lg-8">
            <div class="card">

                <div class="card-body">
                    <div class="form-validation">
                        <form action="{{ route('backend.user.update', $user) }}" method="Post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-lg-4 col-form-label" for="text">Name </label>
                                <div class="col-lg-8">

                                    <input type="text" class="form-control"  required placeholder="Your name" name="name" id="name"
                                        value="{{ $user->name }}">
                                    @error('name')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="mb-3 row">
                                <label class="col-lg-4 col-form-label" for="text">Email </label>
                                <div class="col-lg-8">

                                    <input type="email" class="form-control" placeholder="Your Email" id="email" name="email"
                                        value="{{ $user->email }}">
                                    @error('email')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>


                            <div class="mb-3 row">
                                <label class="col-lg-4 col-form-label" for="text">Mobile </label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" required placeholder="Your Mobile Number" name="mobile" id="phone"
                                        value="{{ $user->mobile }}">
                                    @error('mobile')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>


                            {{-- <div class="mb-3 row">
                                <label class="col-lg-4 col-form-label" for="image">Image


                                </label>
                                <div class="col-lg-8">
                                    <input type="file" name="image" class="dropify"
                                        data-allowed-file-extensions="jpg jpeg png ">

                                    @error('image')
                                        @include('components.backend.forms.input.errorMessage', [
                                            'message' => $errors->first('image'),
                                        ])
                                    @enderror
                                </div>
                            </div> --}}
                            {{-- <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div> --}}



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
