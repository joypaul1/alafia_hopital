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
            <div class="card">
                <div class="card-body">
                    <div class="form-validation">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'business_location', 'optionDatas' => [], 'required'=> true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>
                                    $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'expense_category', 'optionDatas' => [], 'required'=> true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>
                                    $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'sub_category', 'optionDatas' => [], 'required'=> true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>
                                    $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'reference_no', 'placeholder' => 'Enter reference no here...', 'required'=> true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>
                                    $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Date: </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'expense_for', 'optionDatas' => [], 'required'=> true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>
                                    $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'expense_for_contact', 'optionDatas' => [], 'required'=> true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>
                                    $errors->first('name')])
                                </div>
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'total_amount', 'placeholder' => 'Enter total amount here...', 'required'=> true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>
                                    $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Applicable Tax:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-info" aria-hidden="true"></i></span>
                                    </div>
                                    @include('components.backend.forms.select2.option2',[ 'name' => 'expense_for_contact', 'optionDatas' => [], 'required'=> true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>
                                    $errors->first('name')])
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">
                                        Expense note: </label>
                                    <div class="input-group mb-3">
                                        <textarea name="5" placeholder="Expense Notes" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="document">Attach Document:</label>
                                    @include('components.backend.forms.input.input-image',[ 'name' => 'expense-for-contact', 'optionDatas' => [], 'required'=> true ])
                                    <small>
                                        <p class="help-block">Max File size: 5MB <br>
                                            Allowed File:
                                            .pdf,
                                            .csv,
                                            .zip,
                                            .doc,
                                            .docx,
                                            .jpeg,
                                            .jpg,
                                            .png
                                        </p>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6>
                        Add Payment
                    </h6>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <label class="col-form-label">Amount: </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control" value="00" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="col-form-label">Paid on: </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="date" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="col-form-label">Payment Method: </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                    </span>
                                </div>
                                @include('components.backend.forms.select2.option2',[ 'name' => 'payment_method', 'optionDatas' => [], 'required'=> true ])
                                @include('components.backend.forms.input.errorMessage', ['message' =>
                                $errors->first('name')])
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="col-form-label">Payment Account: </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                    </span>
                                </div>
                                @include('components.backend.forms.select2.option2',[ 'name' => 'payment_account', 'optionDatas' => [], 'required'=> true ])
                                @include('components.backend.forms.input.errorMessage', ['message' =>
                                $errors->first('name')])
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="col-form-label">Payment Note: </label>
                            <textarea rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                @include('components.backend.forms.input.submit-button')
            </div>

        </form>
    </div>
</div>


@endsection