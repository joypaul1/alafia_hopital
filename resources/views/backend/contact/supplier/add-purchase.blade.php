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
                    <h5>Add Purchase</h5>
                    <div class="form-validation">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="col-form-label">
                                    Supplier:
                                </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    @include('components.backend.forms.select2.option2',[ 'name' => 'supplier','optionData' => []])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('company_name')])
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'reference_no','placeholder' => 'Enter Reference No here...'])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('company_name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">
                                    Purchase Date:
                                </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control" placeholder="Purchase Date">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'purchase_status', 'optionData'=> [] ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('mobile')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'business_location', 'optionData'=> [] ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('mobile')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">
                                    Pay term:
                                </label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" placeholder="Pay term enter here ...">
                                    <div class="input-group-prepend">
                                        <select name="pay-term-option" id="">
                                            <option value="0" hidden>Please Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-image',[ 'name' => 'attach_document','placeholder' => 'Enter Phone Number here...', ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('email')])
                                </div>
                                <small>Allowed File: .pdf, .csv, .zip, .doc, .docx, .jpeg, .jpg, .png </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-top">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <label class="col-form-label">
                                Purchase Date:
                            </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Enter Product Name / SKU">
                            </div>
                        </div>

                        <div>
                            <button class="btn btn-info">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                Add New Product
                            </button>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Purchase Quantity</th>
                                <th scope="col">Unit Cost (Before Discount)</th>
                                <th scope="col">Discount Percent</th>
                                <th scope="col">Unit Cost (Before Tax)</th>
                                <th scope="col">Subtotal (Before Tax)</th>
                                <th scope="col">Product Tax</th>
                                <th scope="col">Net Cost</th>
                                <th scope="col">Line Total</th>
                                <th scope="col">Profit Margin %</th>
                                <th scope="col">Unit Selling Price (Inc. tax)</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card border-top">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                @include('components.backend.forms.select2.option',[ 'name' => 'discount_type', 'optionData'=> [] ])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('mobile')])
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'discount_Amount', 'number' => true, 'placeholder' => 'Enter Discount Amount'])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('mobile')])
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Discount:(-) 0.00</h6>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                @include('components.backend.forms.select2.option',[ 'name' => 'purchase_tax', 'optionData'=> [] ])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('mobile')])
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">
                            <h6>Purchase Tax:(+) 0.00</h6>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <label class="col-form-label">
                            Additional Notes
                        </label>
                        <textarea class="form-control" rows="5"></textarea>
                    </div>
                </div>
            </div>

            <div class="card border-top">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'shipping_details','placeholder' => 'Enter Shipping Details here...'])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('company_name')])
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'additional_shipping_charges','placeholder' => 'Enter Shipping Charges here...'])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('company_name')])
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6 style="text-align: right;">
                        Purchase Total: $ 0.00
                    </h6>
                </div>
            </div>
            <div class="card border-top">
                <div class="card-body">
                    <h5>
                        Add Payment
                    </h5>
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'amount','placeholder' => 'Enter amount here...', 'required' => true])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('company_name')])
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label">
                                Paid On:
                            </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="date" class="form-control" placeholder="Purchase Date">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label">
                                Payment Method:
                            </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                    </span>
                                </div>
                                @include('components.backend.forms.select2.option2',[ 'name' => 'payment_method','optionData' => []])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('company_name')])
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label">
                                Payment Account:
                            </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                    </span>
                                </div>
                                @include('components.backend.forms.select2.option2',[ 'name' => 'payment_account','optionData' => []])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('company_name')])
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="col-form-label">
                                Payment note:
                            </label>
                            <textarea class="form-control" cols="30" rows="5"></textarea>
                        </div>
                    </div>

                    <hr>
                    <h6 style="text-align: right;">
                        Payment due: $ 0.00
                    </h6>
                </div>
            </div>
            <div class="form-group">
                        @include('components.backend.forms.input.submit-button')
                    </div>
        </form>
    </div>
</div>


@endsection
