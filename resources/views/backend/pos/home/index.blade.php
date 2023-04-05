{{-- @extends('backend.layout.posApp') --}}


@section('page-header')
<i class="fa fa-list"></i> Pos List
@stop
@section('content')


@push('css')
<style>
    .product-grid-container {
        display: grid;
        grid-template-columns: 1fr;
    }

    @media (min-width: 768px) {
        .product-grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }
    }
</style>
@endpush

<div class="row">
    <div class="card d-flex  mt-5">
        <div class="header">
            <span href="#" style="font-size: 18px;font-weight:700">
                <i class="fa fa-desktop"></i> POS
            </span>

            <div class="pull-right">
                <span class="btn btn-danger btn-md mr-1">
                    <i class="fa fa-pause-circle-o" aria-hidden="true"></i> </span>
                <span class="btn btn-dark btn-md mr-1">
                    <i class="fa fa-briefcase" aria-hidden="true"></i> </span>
                <span data-toggle="modal" data-target="#calculatorModal" class="btn btn-info btn-md mr-1">
                    <i class="fa fa-calculator me-1"></i> </span>
                <button class="btn btn-primary btn-md mr-1">Park Sale</button>
                <button class="btn btn-success btn-md mr-1">New Sale</button>
            </div>
            <!-- <span data-toggle="popover" title="Calculator" data-html="true" data-content='@include("components.backend.pos.calculator")' class="btn btn-info btn-md pull-right">
                <i class="fa fa-calculator me-2"></i> Calculator </span> -->
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card border-top">
            <div class="body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                            </div>
                            @include('components.backend.forms.select2.option2',[ 'name' => 'Walk in Customer', 'optionData' => [], 'required'=> true ])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                            <div class="input-group-prepend">
                                <span class="input-group-text" data-toggle="modal" data-target="#customer-type-modal">
                                    <i class="fa fa-plus" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                            </div>
                            @include('components.backend.forms.input.input-type2',[ 'name' => 'Product Name', 'placeholder' => 'Enter Product Name / SKU', 'required'=> true ])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                            <div class="input-group-prepend">
                                <span class="input-group-text" data-toggle="modal" data-target="#product-add-modal">
                                    <i class="fa fa-plus" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="table-responsive">
                    <table ellspacing='0' class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price inc. tax</th>
                                <th>Sub Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Acer Aspire E15 (Color: Black)</td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">-</span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                        <div class="input-group-append">
                                            <span class="input-group-text">+</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Price inc. tax</td>
                                <td>Sub Total</td>
                                <td> Action</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered mt-5">
                        <tbody>
                            <tr>
                                <td><b>Items:</b>&nbsp;
                                    <span class="total_quantity">0.00</span>
                                </td>
                                <td colspan="2">
                                    <b>Total:</b> &nbsp;
                                    <span class="price_total">0.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        Discount (-): <i class="fa fa-pencil-square-o" data-toggle="modal" data-target="#discountModal" style="cursor:pointer;" aria-hidden="true"></i>
                                    </strong>
                                    <span id="total_discount">0.00</span>
                                </td>
                                <td class="">
                                    <span>
                                        <b>Order Tax(+): <i class="fa fa-pencil-square-o" data-toggle="modal" data-target="#taxModal" style="cursor:pointer;" aria-hidden="true"></i> </b>
                                        <span id="order_tax">0.00</span>
                                    </span>
                                </td>
                                <td>
                                    <span>
                                        <b>Shipping(+): <i class="fa fa-pencil-square-o" data-toggle="modal" data-target="#shippingModal" style="cursor:pointer;" aria-hidden="true"></i> </b>
                                        <span id="shipping_charges_amount">0.00</span>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 h-full mb-4">
        <div class="card border-top h-100">
            <div class="body h-100">
                <h5>
                    Products Management
                </h5>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                            </div>
                            @include('components.backend.forms.select2.option2',[ 'name' => 'Product Category', 'optionData' => [], 'required'=> true ])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                            </div>
                            @include('components.backend.forms.select2.option2',[ 'name' => 'Product Brands', 'optionData' => [], 'required'=> true ])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                        </div>
                    </div>
                </div>

                <div class="product-grid-container">
                    <div class="card">
                        <img src="https://pos.ultimatefosters.com/uploads/img/1528727793_acerE15.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Product 01</h5>
                        </div>
                    </div>
                    <div class="card">
                        <img src="https://pos.ultimatefosters.com/uploads/img/1528780234_apples.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Product 02</h5>
                        </div>
                    </div>
                    <div class="card">
                        <img src="https://pos.ultimatefosters.com/uploads/img/1528727817_iphone8.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Product 03</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 text-center pb-5">
        <button type="button" class="btn btn-info">
            <i class="fa fa-edit"></i> Draft</button>
        <button type="button" class="btn btn-warning">
            <i class="fa fa-edit"></i> Quotation
        </button>
        <button type="button" class="btn btn-success">
            <i class="fa fa-stop-circle-o" aria-hidden="true"></i>
            Suspend
        </button>
        <button type="button" class="btn btn-danger">
            <i class="fa fa-check"></i> Credit Sale
        </button>
        <button type="button" class="btn btn-warning">
            <i class="fa fa-credit-card"></i> Card
        </button>
        <button type="button" class="btn btn-dark">
            <i class="fa fa-money"></i> Multiple Pay
        </button>
        <button type="button" class="btn btn-success">
            <i class="fa fa-money"></i> Cash
        </button>
        <button type="button" class="btn btn-danger">
            <i class="fa fa-times"></i>Cancel
        </button>
    </div>
</div>



<!-- Customer Type Modal -->
<div class="modal fade" id="customer-type-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a new contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="customer_type">
                    <div>
                        <label for="business">
                            <input type="radio" id="business" name="user_type" value="2">
                            Business
                        </label>
                        <label for="individual" class='ml-2'>
                            <input type="radio" id="individual" name="user_type" value="1" checked>
                            Individual
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="contact_id">Contact Id:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Contact Id" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <small>Leave this blank to generate automatically</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="contact_id">Customer Group:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <select name="customer_group" id="customer_group" class="form-control">
                                        <option value="" hidden>None</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="userTypeForm">
                        @include('components.backend.pos.business')
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">SAVE</button>
            </div>
        </div>
    </div>
</div>
<!-- Add Product Modal -->
<div class="modal fade" id="product-add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#">
                    @include('components.backend.pos.addProduct')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">SAVE</button>
            </div>
        </div>
    </div>
</div>

<!-- Discount Modal -->
<div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Discount</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="mb-3 row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="contact_id">Discount type:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-info" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <select class="form-control">
                                        <option value="" hidden>Please Select</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="contact_id">Discount Amount:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-info" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Discount Amount">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">SAVE</button>
            </div>
        </div>
    </div>
</div>
<!-- Tax Modal -->
<div class="modal fade" id="taxModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Order Tax</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="form-group mb-3">
                        <label for="contact_id">Order Tax:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-info" aria-hidden="true"></i>
                                </span>
                            </div>
                            <select class="form-control">
                                <option value="" hidden>Please Select</option>
                                <option value="none">None</option>
                                <option value="vat10">VAT @10%</option>
                                <option value="cgst10">CGST @10%</option>
                                <option value="sgst8">SGST @8%</option>
                                <option value="gst18">GST @18%</option>
                            </select>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">SAVE</button>
            </div>
        </div>
    </div>
</div>
<!-- Shipping Modal -->
<div class="modal fade" id="shippingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Shipping Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="mb-3 row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="contact_id">Shipping Details:</label>
                                <textarea name="shipping_details" placeholder="Enter shipping details"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="contact_id">Shipping Address:</label>
                                <textarea name="shipping_details" placeholder="Enter shipping address"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="contact_id">Shipping Charges:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-info" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Shipping Charges">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="contact_id">Shipping Status:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-truck" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <select class="form-control">
                                        <option value="" hidden>Please Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="contact_id">Delivered to:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Customer Name">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">SAVE</button>
            </div>
        </div>
    </div>
</div>
<!-- Calculator Modal -->
<div class="modal fade" id="calculatorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @include('components.backend.pos.calculator')
        </div>
    </div>
</div>

{{-- @endsection --}}

@push('js')
<script>
    let table_name = $(".unit_table");
    $(function() {
        table_name.DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print"],
            processing: true,
            serverSide: true,
            destroy: true,
            pageLength: 10,
            ajax: "{{ route('backend.itemconfig.unit.index') }}",
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            }, {
                data: 'name',
                name: 'name'
            }, {
                data: 'note',
                name: 'note'
            }, {
                data: 'status',
                name: 'status'
            }, {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }, ],
        });
    });
    $(document).ready(() => {
        $('#customer_type input').on('change', () => {
            let radioValue = $('input[name=user_type]:checked', '#customer_type').val()
            if (radioValue == '1') {
                $("#userTypeForm").html(`
                    @include('components.backend.pos.individual')
                `)
            } else {
                $("#userTypeForm").html(`
                    @include('components.backend.pos.business')
                `)
            }
        });

    })
</script>

@endpush
