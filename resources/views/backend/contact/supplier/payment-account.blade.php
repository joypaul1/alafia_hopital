@extends('backend.layout.app')
@include('backend._partials.datatable__delete')


@section('page-header')
<!-- <i class="fa fa-plus-circle"></i> -->
Payment Accounts
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Supplier List',
'route' => route('backend.supplier.index')
])

@push('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endpush

<div class="card border-top">
    <div class="body">
        <!-- Nav tabs -->
        <div id="tabs">
            <ul>
                <li><a href="#tabs-1"><i class="fa fa-book" aria-hidden="true"></i> Accounts</a></li>
                <li><a href="#tabs-2"><i class="fa fa-list-ul" aria-hidden="true"></i> Account Types</a></li>
            </ul>
            <div id="tabs-1">
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <select class="form-control">
                            <option value="active">Active</option>
                            <option value="close">Close</option>
                        </select>
                    </div>
                    <button class="btn btn-info">
                        <i class="fa fa-plus"></i>
                        Add
                    </button>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Account Type</th>
                            <th>Account Sub Type</th>
                            <th>Account Number</th>
                            <th>Note</th>
                            <th>Balance</th>
                            <th>Account Details</th>
                            <th>Added By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Acer Aspire
                            </td>
                            <td>
                                Current Asset
                            </td>
                            <td>
                                Cash & Bank
                            </td>
                            <td>
                                3
                            </td>
                            <td>

                            </td>
                            <td>
                                $ 900.00
                            </td>
                            <td>

                            </td>
                            <td>
                                Admin
                            </td>
                            <td>
                                <button class="btn btn-success">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </button>
                                <button class="btn btn-primary">
                                    <i class="fa fa-book"></i>
                                    Account Book</button>
                                <button class="btn btn-info">
                                    Fund Transfer
                                </button>
                                <button class="btn btn-success">
                                    <i class="fa fa-money"></i>
                                    Deposit
                                </button>
                                <button class="btn btn-danger">
                                    <i class="fa fa-power-off"></i>
                                    Close
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="4">

                            </th>
                            <th>
                                Total:
                            </th>
                            <th colspan="5">
                                $ 5564.154
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="tabs-2">
                <div class="d-flex justify-content-between mb-3">
                    <div>

                    </div>
                    <button class="btn btn-info">
                        <i class="fa fa-plus"></i>
                        Add
                    </button>
                </div>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                Current Asset
                            </th>
                            <td>
                                <button class="btn btn-info">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </button>

                                <button class="btn btn-danger">
                                    <i class="fa fa-trash-o"></i>
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                -- Cash & Bank
                            </td>
                            <td>
                                <button class="btn btn-info">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </button>

                                <button class="btn btn-danger">
                                    <i class="fa fa-trash-o"></i>
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                -- Delivery AC
                            </td>
                            <td>
                                <button class="btn btn-info">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </button>

                                <button class="btn btn-danger">
                                    <i class="fa fa-trash-o"></i>
                                    Delete
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>



@endsection

@push('js')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(function() {
        $("#tabs").tabs();
    });
</script>

@endpush