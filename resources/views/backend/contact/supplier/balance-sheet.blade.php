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
                                <th scope="col" colspan="2">Liability</th>
                                <th scope="col" colspan="2">Assets</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Supplier Due:</td>
                                <td> $ 20,330.00 </td>
                                <td>Customer Due:</td>
                                <td> $ 0.00 </td>
                            </tr>
                            <tr>
                                <td rowspan="2" colspan="2"></td>
                                <td>Closing stock:</td>
                                <td> $ 151,280.00 </td>
                            </tr>
                            <tr>
                                <td>Account Balances:</td>
                                <td> $00 </td>
                            </tr>
                            <tr class="table-active">
                                <th scope="col">Total Liability</th>
                                <th scope="col"> $ 20,330.00 </th>
                                <th scope="col">Total Assets</th>
                                <th scope="col"> $ 151,280.00 </th>
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