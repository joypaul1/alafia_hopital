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
                <div class="body">
                    <h4 class="pointer text-info" id="toggleFilter">
                        <i class="fa fa-filter"></i> Filter
                    </h4>
                    <div id="filterContainer">
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'business_location', 'required'=>true, 'optionDatas' => [] ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label class="col-form-label">Filter by date: </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-active">
                                <th scope="col" colspan="2">Trial Balance</th>
                                <th scope="col">Debit</th>
                                <th scope="col">Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">Supplier Due:</td>
                                <td></td>
                                <td>$ 20,330.00</td>
                            </tr>
                            <tr>
                                <td colspan="2">Customer Due:</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2">Account Balances:</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="table-active">
                                <th scope="col" colspan="2">Total</th>
                                <th scope="col">$ 0.00</th>
                                <th scope="col">$ 20,330.00</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="form-group">
                @include('components.backend.forms.input.submit-button')
            </div>

        </form>
    </div>
</div>


@endsection

@push('js')
<script>
     $(document).ready(() => {
        $('#toggleFilter').click(() => {
            $('#filterContainer').slideToggle();
        })
    })
</script>
@endpush