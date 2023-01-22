@extends('backend.layout.app')
@include('backend._partials.datatable__delete')


@section('page-header')
<!-- <i class="fa fa-plus-circle"></i> -->
Profit / Loss Report
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
        <h4 class="pointer text-info" id="toggleFilter">
            <i class="fa fa-filter"></i> Filter
        </h4>
        <div id="filterContainer">
            <hr>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></span>
                        </div>
                        @include('components.backend.forms.select2.option2',[ 'name' => 'business_location', 'required'=>true, 'optionDatas' => [] ])
                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-calendar mr-2" aria-hidden="true"></i>Filter By Date
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Today</a>
                            <a class="dropdown-item" href="#">Yesterday</a>
                            <a class="dropdown-item" href="#">Last 7 Days</a>
                            <a class="dropdown-item" href="#">Last 30 Days</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card border-top">
            <div class="body">
                <!-- <h6 class="mb-4"> All Expenses</h6> -->
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>
                                <h6>Opening Stock</h6>
                                <small>(By purchase price):</small>
                            </td>
                            <td>
                                $0.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Opening Stock</h6>
                                <small>(By sale price):</small>
                            </td>
                            <td>
                                $0.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Total purchase:</h6>
                                <small>(Exc. tax, Discount):</small>
                            </td>
                            <td>
                                $ 386,936.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Total Stock Adjustment:</h6>
                            </td>
                            <td>
                                $ 0.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Total Expense:</h6>
                            </td>
                            <td>
                                $ 0.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Total purchase shipping charge:</h6>
                            </td>
                            <td>
                                $ 0.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Purchase additional expenses:</h6>
                            </td>
                            <td>
                                $ 0.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Total transfer shipping charge:</h6>
                            </td>
                            <td>
                                $ 0.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Total Sell discount:</h6>
                            </td>
                            <td>
                                $ 0.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Total customer reward:</h6>
                            </td>
                            <td>
                                $ 0.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Total Sell Return:</h6>
                            </td>
                            <td>
                                $ 11.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Total Payroll:</h6>
                            </td>
                            <td>
                                $ 0.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Total Production Cost:</h6>
                            </td>
                            <td>
                                $ 0.00
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-top">
            <div class="body">
                <!-- <h6 class="mb-4"> All Expenses</h6> -->
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>
                                <h6>Closing stock </h6>
                                <small>(By purchase price):</small>
                            </td>
                            <td>
                                $ 382,697.40
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Closing stock </h6>
                                <small>(By sale price):</small>
                            </td>
                            <td>
                                $ 465,721.75
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Total Sale </h6>
                                <small> (Exc. tax, Discount) :</small>
                            </td>
                            <td>
                                $ 465,721.75
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Total sell shipping charge: </h6>
                            </td>
                            <td>
                                $ 0.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Sell additional expenses: </h6>
                            </td>
                            <td>
                                $ 0.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Total Stock Recovered: </h6>
                            </td>
                            <td>
                                $ 0.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Total Purchase Return: </h6>
                            </td>
                            <td>
                                $ 0.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Total Purchase discount:</h6>
                            </td>
                            <td>
                                $ 0.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Total sell round off:</h6>
                            </td>
                            <td>
                                $ 0.00
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card border-top">
            <div class="body">
                <h4 class="text-secondary"> Gross Profit: $ 1,059.65 </h4>
                <small> (Total sell price - Total purchase price) </small>
                <h4 class="text-secondary"> Net Profit: $ 529.83 </h4>
                <small> Gross Profit + (Total sell shipping charge + Sell additional expenses + Total Stock Recovered + Total Purchase discount + Total sell round off )
                    - ( Total Stock Adjustment + Total Expense + Total purchase shipping charge + Total transfer shipping charge + Purchase additional expenses + Total Sell discount + Total customer reward + Total Payroll + Total Production Cost ) </small>
            </div>
        </div>
    </div>
</div>

<div class="card border-top">
    <div class="body">
        <!-- Nav tabs -->
        <div id="tabs">
            <ul>
                <li><a href="#tabs-1"><i class="fa fa-cubes" aria-hidden="true"></i> Profit by Product</a></li>
                <li><a href="#tabs-2"><i class="fa fa-tags" aria-hidden="true"></i> Profit by Category</a></li>
                <li><a href="#tabs-3"><i class="fa fa-university" aria-hidden="true"></i> Profit by Brands</a></li>
                <li><a href="#tabs-4"><i class="fa fa-map-marker" aria-hidden="true"></i> Profit by Locations</a></li>
                <li><a href="#tabs-5"><i class="fa fa-sticky-note" aria-hidden="true"></i> Profit by invoice</a></li>
                <li><a href="#tabs-6"><i class="fa fa-calendar" aria-hidden="true"></i> Profit by date</a></li>
                <li><a href="#tabs-7"><i class="fa fa-users" aria-hidden="true"></i> Profit by customers</a></li>
                <li><a href="#tabs-8"><i class="fa fa-calendar" aria-hidden="true"></i> Profit by day</a></li>
            </ul>
            <div id="tabs-1">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Gross Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Acer Aspire E 15 - Color - Black (AS0017-1)
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Acer Aspire E 15 - Color - Black (AS0017-1)
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Acer Aspire E 15 - Color - Black (AS0017-1)
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <h5>Total:</h5>
                            </th>
                            <th>
                                $ 1080.40
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="tabs-2">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Gross Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Sports
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Foods
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Electronics
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <h5>Total:</h5>
                            </th>
                            <th>
                                $ 1080.40
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="tabs-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Brands</th>
                            <th>Gross Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Apple
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Acer
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Sony
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <h5>Total:</h5>
                            </th>
                            <th>
                                $ 1080.40
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="tabs-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Locations</th>
                            <th>Gross Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Awesome Shop
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <h5>Total:</h5>
                            </th>
                            <th>
                                $ 1080.40
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="tabs-5">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Gross Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                AS154585
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <td>
                                AS154654
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <h5>Total:</h5>
                            </th>
                            <th>
                                $ 1080.40
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="tabs-6">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Gross Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                31 / 03 / 2022
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <td>
                                05 / 03 / 2022
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <h5>Total:</h5>
                            </th>
                            <th>
                                $ 1080.40
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="tabs-7">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Gross Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Sulaiman
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <td>
                               Walk in Customer
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <h5>Total:</h5>
                            </th>
                            <th>
                                $ 1080.40
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="tabs-8">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Gross Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Friday
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <td>
                               Saturday
                            </td>
                            <td>
                                $ 382.40
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <h5>Total:</h5>
                            </th>
                            <th>
                                $ 1080.40
                            </th>
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