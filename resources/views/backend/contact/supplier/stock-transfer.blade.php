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
                        <div class="row align-items-center">
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
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'reference_no', 'placeholder' => 'Enter reference no here...', 'required'=> true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>
                                    $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'status', 'optionDatas' => [], 'required'=> true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>
                                    $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'location_(from)', 'optionDatas' => [], 'required'=> true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>
                                    $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'location_(to)', 'optionDatas' => [], 'required'=> true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>
                                    $errors->first('name')])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6>
                        Search Products
                    </h6>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row"></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><i class="fa fa-trash" aria-hidden="true"></i></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3"></th>
                                        <td colspan="2">
                                            <h6>Total: 00 </h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'shipping-charge', 'placeholder' => 'Enter shipping charge here...', 'required'=> true, 'number' => true ])
                                @include('components.backend.forms.input.errorMessage', ['message' =>
                                $errors->first('name')])
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label">
                                Additional Notes: </label>
                            <div class="input-group mb-3">
                                <textarea name="5" placeholder="Additional Notes" class="form-control" rows="3"></textarea>
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