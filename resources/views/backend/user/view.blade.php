@extends('backend.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/dropify/css/dropify.min.css">
    <link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/font-awesome/css/font-awesome.min.css" />
    <style>
        input,
        textarea {
            border: none;
        }
    </style>
@endpush
@section('page-header')
    <i class="fa fa-plus"></i> User Information
@stop

@section('content')
    @include('backend._partials.page_header', [
        'fa' => 'fa fa-list',
        'name' => 'Visa List',
        'route' => route('backend.visa.index'),
    ])


    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                @if ($visa)
                    <div class="card-body">
                        <div class="form-validation">
                            <div class="mb-3 row">
                                <label class="col-lg-4 col-form-label" for="text">Name </label>
                                <div class="col-lg-8">
                                    <input type="hidden" name="user_id" value="{{ $visa->user_id }}">

                                    <input readonly type="text" value="{{ $visa->name }}" n placeholder="Your name"
                                        name="name" id="name">
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

                                    <input readonly type="email" value="{{ $visa->email }}" placeholder="Your Email"
                                        id="email" name="email">
                                    @error('email')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-4 col-form-label" for="text">Address </label>
                                <div class="col-lg-8">
                                    <textarea readonly name="address">{{ $visa->address }}</textarea>
                                    @error('address')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="mb-3 row">
                                <label class="col-lg-4 col-form-label" for="text">Mobile </label>
                                <div class="col-lg-8">
                                    <input readonly type="text" value="{{ $visa->mobile }}" n
                                        placeholder="Your Mobile Number" name="mobile" id="phone">
                                    @error('mobile')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>


                            <div class="mb-3 row">
                                <label class="col-lg-4 col-form-label" for="image">Image
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-4">
                                    <img class="card-img-top img-fluid" src="{{ asset($visa->image) }}"
                                        alt="Current Image">

                                </div>
                            </div>



                        </div>
                    </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Uploaded Document</h4>
                </div>
                <div class="card-body">
                    <h5>Passport</h5>
                    <div class="col-lg-8">
                        <a href="javascript:void(0)" class="im1" data-toggle="modal"
                            data-image="{{ asset($visa->pp_bio) }}">
                            <img class="card-img-top img-fluid" src="{{ asset($visa->pp_bio) }}" alt="Current Image">
                        </a>
                    </div>
                    <h5>Bank Statement</h5>
                    <div class="col-lg-8">

                        <a href="#" class="im1" data-toggle="modal"
                            data-image="{{ asset($visa->bank_statement) }}">
                            <img class="card-img-top img-fluid" src="{{ asset($visa->bank_statement) }}"
                                alt="Current Image">
                        </a>
                    </div>
                    <h5>NID</h5>
                    <div class="col-lg-8">

                        <a href="#" class="im1" data-toggle="modal" data-image="{{ asset($visa->nid) }}">
                            <img class="card-img-top img-fluid" src="{{ asset($visa->nid) }}" alt="Current Image">
                        </a>
                    </div>
                    <h5>NOC</h5>
                    <div class="col-lg-8">

                        <a href="#" class="im1" data-toggle="modal" data-image="{{ asset($visa->noc) }}">
                            <img class="card-img-top img-fluid" src="{{ asset($visa->noc) }}" alt="Current Image">
                        </a>
                    </div>
                    <h5>TIN</h5>
                    <div class="col-lg-8">

                        <a href="#" class="im1" data-toggle="modal" data-image="{{ asset($visa->tin) }}">
                            <img class="card-img-top img-fluid" src="{{ asset($visa->tin) }}" alt="Current Image">
                        </a>
                    </div>

                    <h5>Marriage Certificate</h5>
                    <div class="col-lg-8">

                        <a href="#" class="im1" data-toggle="modal"
                            data-image="{{ asset($visa->marriage_certificate) }}">
                            <img class="card-img-top img-fluid" src="{{ asset($visa->marriage_certificate) }}"
                                alt="Current Image">
                        </a>
                    </div>
                    <h5>Salary Certificate</h5>
                    <div class="col-lg-8">

                        <a href="#" class="im1" data-toggle="modal"
                            data-image="{{ asset($visa->salary_certificate) }}">
                            <img class="card-img-top img-fluid" src="{{ asset($visa->salary_certificate) }}"
                                alt="Current Image">
                        </a>
                    </div>
                    <h5>Import Export Certificate</h5>
                    <div class="col-lg-8">

                        <a href="#" class="im1" data-toggle="modal"
                            data-image="{{ asset($visa->impexp_certificate) }}">
                            <img class="card-img-top img-fluid" src="{{ asset($visa->impexp_certificate) }}"
                                alt="Current Image">
                        </a>
                    </div>
                    <h5>Visiting Card</h5>
                    <div class="col-lg-8">

                        <a href="#" class="im1" data-toggle="modal"
                            data-image="{{ asset($visa->visiting_card) }}">
                            <img class="card-img-top img-fluid" src="{{ asset($visa->visiting_card) }}"
                                alt="Current Image">
                        </a>
                    </div>
                    <h5>Bar Council Certificate</h5>
                    <div class="col-lg-8">

                        <a href="#" class="im1" data-toggle="modal"
                            data-image="{{ asset($visa->bar_council) }}">
                            <img class="card-img-top img-fluid" src="{{ asset($visa->bar_council) }}"
                                alt="Current Image">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <h3>Visa Application Not created</h3>
        @endif
    </div>

    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>

                </div>
                <div class="modal-body">
                    <img src="#" alt="" class="outputImage" width='100%' height="50%">
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('assets/backend') }}/vendor/dropify/js/dropify.min.js"></script>
    <script src="{{ asset('assets/backend') }}/js/pages/forms/dropify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('.im1').click(function() {
                var imgsrc = $(this).data('image');

                $('#defaultModal .modal-body  .outputImage').attr('src', imgsrc);
                // show Modal
                $('#defaultModal').modal('show');


            });
        });
    </script>
@endpush
