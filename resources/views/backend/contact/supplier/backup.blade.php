@extends('backend.layout.app')

@section('page-header')
<i class="fa fa-plus-circle"></i> Supplier Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Supplier List',
'route' => route('backend.supplier.index')
])

<div class="row">
    <div class="col-lg-12">
        <form class="needs-validation" action="{{ route('backend.supplier.store') }}" method="Post" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="card border-top">
                <div class="card-body">
                    <div class="form-validation">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'name','placeholder' => 'Enter supplier name here...', 'required'=> true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'company_name','placeholder' => 'Enter Company Name here...'])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('company_name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" name="status" id="active_check">
                                    <label class="form-check-label" for="active_check">Active ?</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'mobile', 'number'=> true, 'placeholder' => 'Enter mobile Number here...', 'required'=> true])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('mobile')])
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'email','placeholder' => 'Enter Phone Number here...', ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('email')])
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'label' => 'country','name' => 'country_id','optionDatas'=> $countries])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('country_id')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'province', 'placeholder' => 'Enter your province name here...'])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>  $errors->first('province')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'city', 'placeholder' => 'Enter your city name here...' ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('city')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'postal_code', 'number' => true, 'placeholder' => 'Enter Postal Code here...' ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'address_line_1', 'placeholder' => 'Enter Address Line 1 here...'])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('address_line_1')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'address_line_2', 'placeholder' => 'Enter Address Line 2 here...'])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('address_line_2')])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-top">
                <div class="card-body">
                    <h6>
                        Any Related Document
                        <hr>
                    </h6>
                    <div class="form-validation">
                        <div class="col-md-12 document">
                            <div class="form-group ">
                                @include('components.backend.forms.input.input-image',[ 'name' => 'document[]' ])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('image')])
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        @include('components.backend.forms.input.submit-button')
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>


@endsection