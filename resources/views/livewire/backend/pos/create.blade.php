@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <style>
        .ui-autocomplete {
            position: absolute;
            cursor: default;
            z-index: 99999999999999 !important
        }

        .product-grid-container {
            display: grid;
            grid-template-columns: 1fr;
        }

        .tb-active {
            background: green !important;
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

<div>

    <div class="row">
        <div class="card d-flex  mt-5">
            <div class="header">
                <span href="#" style="font-size: 18px;font-weight:700">
                    <i class="fa fa-desktop"></i> POS (Dialysis Of Invoice Service Center)
                </span>

                <div class="pull-right">
                     {{-- <span class="btn btn-danger btn-md mr-1">
                        <i class="fa fa-pause-circle-o" aria-hidden="true"></i> </span>
                    <span class="btn btn-dark btn-md mr-1"> --}}
                        {{-- <i class="fa fa-briefcase" aria-hidden="true"></i> </span> --}}
                    <span data-toggle="modal" data-target="#calculatorModal" class="btn btn-info btn-md mr-1">
                        <i class="fa fa-calculator me-1"></i> </span>
                    <button class="btn btn-primary btn-md mr-1">All Invoice </button>
                    <a href="{{ url('admin/pos/pos') }}">
                        <button class="btn btn-warning text-white btn-md mr-1" onclick="deleteAll()">New Sale</button>
                    </a>
                    {{--<a href="{{ route('backend.order.order-list-pending.index') }}" target="_blank"><button
                            class="btn btn-info btn-md mr-1">Pending List</button></a>
                    <a href="{{ route('backend.order.order-list-processing.index') }}" target="_blank"><button
                            class="btn btn-primary btn-md mr-1">Processing List</button></a>
                    <a href="{{ route('backend.order.order-list-delivered.index') }}" target="_blank"><button
                            class="btn btn-success btn-md mr-1">Delivered List</button></a> --}}
                </div>

                {{-- <span data-toggle="popover" title="Calculator" data-html="true"
                data-content='@include("components.backend.pos.calculator")'
                 class="btn btn-info btn-md pull-right">
                <i class="fa fa-calculator me-2"></i>  </span> --}}
            </div>
        </div>
        {{-- <div class="card border-top">
            <div class="body">
                <div wire:ignore
                    style="display: grid;grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));gap: 15px;">
                    @for ($i = 0; $i < count($this->dataTable); $i++)
                        <div class="btn tableBtn @if ($this->dataTable[$i]->booked) tb-active @endif"
                            style="background: #2099ac; color: #fff;"
                            onClick='selectedTable({{ $this->dataTable[$i]->id }}, this)'>
                            <i class="fa fa-chair"></i>{{ $this->dataTable[$i]->name }}
                        </div>
                    @endfor
                </div>
            </div>
        </div> --}}


        <div class="col-lg-7">
            <div class="card border-top">
                <div class="body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                </div>
                                @include('components.backend.forms.input.input-type2', [
                                    'name' => 'user_id',
                                    'placeholder' => 'Patient Name/Id/Mobile num..',
                                    'value' => $userDetails,
                                    'required' => true,
                                ])

                                <div class="input-group-prepend">
                                    <span class="input-group-text" data-toggle="modal"
                                        data-target="#customer-type-modal">
                                        <i class="fa fa-plus" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search-plus"
                                            aria-hidden="true"></i></span>
                                </div>
                                @include('components.backend.forms.input.input-type2', [
                                    'name' => 'product_name',
                                    'placeholder' => 'Enter Product Name / SKU',
                                    // 'value' =>$serviceNameDetails,
                                    'required' => true,
                                ])

                                <div class="input-group-prepend">
                                    <span class="input-group-text" data-toggle="modal" data-target="#product-add-modal">
                                        <i class="fa fa-plus" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table ellspacing='0' class="table table-bordered text-center pos-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price </th>
                                    <th>Sub Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($basket as $serviceNameId=>$serviceName)
                                    <livewire:backend.pos.component.cart-service-name :serviceName="$serviceName" :serviceNameId="$serviceNameId"
                                        wire:key="{{ $loop->index }}" />
                                @empty
                                @endforelse


                            </tbody>
                        </table>
                        <table class="table table-bordered text-center mt-5">
                            <tbody>
                                <tr class="text-right">

                                    <td colspan="3" >
                                        <b>Qty:</b>&nbsp;
                                        <span class="mr-5">{{ number_format($this->serviceNameQty ?? 0, 2) }}</span>
                                        {{-- <b>serviceNames:</b>&nbsp;
                                        <span class="mr-5">{{ number_format($this->serviceNameCount ?? 0, 2) }}</span> --}}
                                        <b>Subtotal:</b> &nbsp;
                                        <strong
                                            class="sub_total">{{ number_format($this->cartSubTotal ?? 0, 2) }}</strong>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <strong>
                                            Discount (-): <i class="fa fa-pencil-square-o" data-toggle="modal"
                                                data-target="#discountModal" style="cursor:pointer;"
                                                aria-hidden="true"></i>
                                        </strong>
                                        <span id="total_discount">{{ number_format($this->discount ?? 0, 2) }}</span>
                                    </td>
                                    {{-- <td class="">
                                        <span>
                                            <b>Order Tax(+): <i class="fa fa-pencil-square-o" data-toggle="modal"
                                                    data-target="#taxModal" style="cursor:pointer;"
                                                    aria-hidden="true"></i> </b>
                                            <span id="order_tax" {{ number_format($this->taxAmount ?? 0, 2) }}</span>
                                            </span>
                                    </td> --}}
                                    {{-- <td>
                                        <span>
                                            <b>Shipping(+): <i class="fa fa-pencil-square-o" data-toggle="modal"
                                                    data-target="#shippingModal" style="cursor:pointer;"
                                                    aria-hidden="true"></i> </b>
                                            <span
                                                id="shipping_charges_amount">{{ number_format($this->shippingCost ?? 0, 2) }}</span>
                                        </span>
                                    </td> --}}
                                </tr>

                            </tbody>
                            <tfoot>
                                {{-- <tr>
                                    <td colspan="2" class="text-right">
                                        <label for="service_charge">Service Charge </label>
                                        <input type="checkbox" wire:click="serviceCharge"
                                            id="service_charge"wire:model='service_charge'>

                                    </td>
                                    <td class="text-right">

                                        <b>Service Amount:</b> &nbsp;
                                        <span class="total">{{ number_format($cartServiceCharge ?? 0, 2) }}</span>

                                    </td>
                                </tr> --}}
                                <tr>
                                    <td colspan="3" class="text-right">
                                        <h6>
                                            <b>Total:</b> &nbsp;
                                            <strong class="total">{{ number_format($cartTotal ?? 0, 2) }}</strong>
                                        </h6>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 h-full mb-4">
            <div class="card border-top h-100">
                <div class="body h-100">
                    <h5>
                        Service Management
                    </h5>
                    <div class="row mt-3">

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-search-plus"
                                            aria-hidden="true"></i></span>
                                </div>
                                @include('components.backend.forms.select2.option2', [
                                    'name' => 'product_brand',
                                    'optionData' => $this->units,
                                ])

                            </div>
                        </div>


                    </div>

                    <div class="product-grid-container">
                        @forelse ($serviceNames as $serviceName)
                            <a href="#" wire:click="addToCard({{ $serviceName->id }})">
                                <div class="card text-center">
                                    <img src="{{ asset('assets/service.png') }}" class="card-img-top" alt="...">
                                    <div class="card-body" style="padding:.75em">
                                        <h6 class="card-title">{{ $serviceName->name }}</h6>
                                        <h6>{{ number_format($serviceName->service_price, 2) }}</h6>
                                    </div>

                                </div>
                            </a>

                        @empty
                        @endforelse


                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row position-fixed fixed-bottom bg-white">
        <div class="col-12 text-center">
            <button type="button" wire:click="storeData('pending')" class="btn btn-info">
                <i class="fa fa-money"></i> {{ __('Save & Print') }}
            </button>
            {{-- <button type="button" wire:click="storeData('processing')" class="btn btn-primary">
                <i class="fa fa-money"></i> {{ __('Processing') }}
            </button>
            <button type="button" wire:click="storeData('delivered')" class="btn btn-info">
                <i class="fa fa-money"></i> {{ __('Delivered') }}
            </button> --}}
            {{-- <button type="button" wire:click="storeData('pending')" class="btn btn-info">
                <i    class="fa fa-money"></i> {{ __('Pending') }}
            </button> --}}
            <button onclick="deleteAll()" type="button" class="btn btn-danger">
                <i class="fa fa-times"></i>Cancel / Clear
            </button>
        </div>
    </div>


    <div wire:ignore  class="modal fade" id="discountModal" data-backdrop="static" data-bs-keyboard="false" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">{{ __('Discount') }}</h5>
                </div>
                <div class="modal-body" wire:ignore.self>
                    <form action="#">
                        <div class="mb-3 row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="contact_id">Discount:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-info" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" wire:model="discount"  class="form-control" placeholder="Discount Amount">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="contact_id">Discount type:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-info" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <select class="form-control" wire:change="discountCal($event.target.value)" >
                                            <option value="{{ null }}" hidden>Please Select</option>
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
                                        <input type="text" readonly wire:model="discount_amount" class="form-control" placeholder="Discount Amount">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function openModal() {
            var myModal = new bootstrap.Modal(document.getElementById('discountModal'));
            myModal.show();
        }
        openModal();
    </script>
    @if ($invoice_url)
        <div wire:ignore.self class="modal fade" id="inv_modal" data-backdrop="static" data-bs-keyboard="false"
            data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">{{ __('Invoice') }}</h5>
                    </div>
                    <div class="modal-body">
                        <iframe src="{{ $invoice_url }}" frameborder="0" width="100%;" height="600px;"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function openModal() {
                var myModal = new bootstrap.Modal(document.getElementById('inv_modal'));
                myModal.show();
            }
            openModal();
        </script>
    @endif

</div>


@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        let total = 0;
        $('#product_category').on('change', function(e) {
            @this.set('unit_id', e.target.value);
        });
        $('#product_brand').on('change', function(e) {
            @this.set('brand_id', e.target.value);
        });
        // document.addEventListener('livewire:load', function () {
        $("#product_name").autocomplete({
            source: function(request, response) {
                var optionData = request.term;
                $.ajax({
                    method: 'GET',
                    url: "{{ route('backend.siteConfig.serviceName.index') }}",
                    data: {
                        'optionData': optionData
                    },
                    success: function(res) {
                        var resArray = $.map(res.data, function(obj) {
                            return {
                                value: obj.name, //Fillable in input field
                                value_id: obj.id, //Fillable in input field
                                label: 'Name:' + obj.name + ' price:' + obj.service_price, //Show as label of input fieldname: obj.name, sku: obj.sku
                            }
                        })
                        response(resArray);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                @this.addToCard(ui.item.value_id)
            }
        });
        $("#user_id").autocomplete({
            source: function(request, response) {
                var optionData = request.term;
                $.ajax({
                    method: 'GET',
                    url: "{{ route('backend.patient.index') }}",
                    data: {
                        'optionData': optionData
                    },
                    success: function(res) {
                        var resArray = $.map(res.data, function(obj) {
                            return {
                                value: obj.name + '(' + obj.mobile +')', //Fillable in input field
                                value_id: obj.id, //for selected data
                                label: obj.name + ' mobile:' + obj.mobile, //Show as label of input fieldname: obj.name, mobile: obj.mobile
                            }
                        })
                        response(resArray);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                console.log(ui.item.value_id);
                @this.userId = ui.item.value_id;
                @this.userDetails = ui.item.value;
            }
        });


        // }) //  end addEventListener

        $(document).on('click', '.pos-table .increment', function(event) {
            @this.qtyCalculation('increment', $(this).attr("data-serviceNameId"))

        });
        $(document).on('click', '.pos-table .decrement', function(event) {
            let getData = $(this).closest('.input-group').find('input[type=number]').val().replaceAll(',', '');
            if (Number(getData) > 1) {
                @this.qtyCalculation('decrement', $(this).attr("data-serviceNameId"))
            }
        });


        function deleteServiceName(here, serviceNameId) {
            here.parents('tr').fadeOut("normal", function() {
                $(this).remove();
            });

            @this.deleteServiceName(serviceNameId)

        }

        function deleteAll() {
            $(".pos-table > tbody").fadeOut("normal").empty();
            @this.resetData()
        }
    </script>
    <script>
        let bookedTable = [];
        window.addEventListener('alert', event => {
            toastr[event.detail.type](event.detail.message,
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });


        // function selectedTable(tableId, here) {
        //     if (jQuery.inArray(tableId, bookedTable) != 0) {
        //         $(here).toggleClass('tb-active');
        //         bookedTable.push(tableId);
        //     } else {
        //         bookedTable = $.grep(bookedTable, function(value) {
        //             return value != tableId;
        //         });
        //         $(here).toggleClass('tb-active');
        //     }
        //     @this.set('selectedTable', bookedTable);
        // }
    </script>
@endpush
