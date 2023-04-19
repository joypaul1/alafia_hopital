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
        .st0{fill:#96E291;}
	.st1{fill:#FFFFFF;}
	.st2{font-family:'ArialMT';}
	.st3{font-size:10.4305px;}
    </style>
@endpush

<div>

    <div class="row">
        <div class="card d-flex  mt-5">
            <div class="header">
                <span href="#" style="font-size: 18px;font-weight:700">
                    <i class="fa fa-desktop"></i> POS (Dialysis Of Invoice Ticket Center)
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



        <div class="col-lg-7">
            <div class="card border-top">
                <div class="card-header"><h5>Select Date</h5></div>
                <div class="body">
                    <div wire:ignore
                        style="display: grid;grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));gap: 15px;">
                        @foreach ($this->dateTable as $key=> $date )
                        <div class="btn tableBtn"
                            style="background: #2099ac; color: #fff;"
                            onclick='selectedDate({{ $key }}, this)'>
                           {{$date }}
                        </div>
                        @endforeach


                    </div>
                </div>
            </div>
            <div class="card border-top ">
                <div class="card-header"><h5>Select Movie</h5></div>
                <div class="body row ">
                    @for ($i = 0; $i < 6; $i++)
                    <a href="#" wire:click="addToCard({{ $i }})" class="col-2">
                        <div class="card text-center " >
                            <img src="{{ asset('assets/login/movie_'.$i.'.jpg') }}" class="card-img-top" alt="...">
                            <div class="card-body" style="padding:.75em">
                                <h6 class="card-title">{{ $i }}</h6>
                                {{-- <h6>{{ number_format($serviceName->service_price, 2) }}</h6> --}}
                            </div>

                        </div>
                    </a>
                    @endfor



                </div>
            </div>
            <div class="card border-top">
                <div class="card-header"><h5>Select Show Time</h5></div>
                <div class="body">
                    <div wire:ignore
                        style="display: grid;grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));gap: 15px;">
                        {{-- @foreach ($this->dateTable as $key=> $date ) --}}
                        <div class="btn tableBtn"
                            style="background: #2099ac; color: #fff;"
                            onclick='selectedDate({{ $key }}, this)'>
                           10am-1pm
                        </div>
                        <div class="btn tableBtn"
                            style="background: #2099ac; color: #fff;"
                            onclick='selectedDate({{ $key }}, this)'>
                           2pm-5pm
                        </div>
                        <div class="btn tableBtn"
                            style="background: #2099ac; color: #fff;"
                            onclick='selectedDate({{ $key }}, this)'>
                           6pm-9pm
                        </div>
                        {{-- @endforeach --}}


                    </div>
                </div>
            </div>
            <div class="card border-top">

                <div class="body">
                    <div class="row">
                        {{-- <div class="col-md-6">
                            <div class="card-header"><h5>Ticket Quantity</h5></div>
                            <div class="input-group" style="width: 150px;">
                                <div class="input-group-prepend decrement" data-servicenameid="26" style="cursor:pointer">
                                    <span class="input-group-text ">-</span>
                                </div>
                                <input type="number" wire:keyup="updateQty($event.target.value,'26')" name="qty[26][ ]" value="1" class="form-control text-center">
                                <div class="input-group-append increment" data-servicenameid="26" style="cursor:pointer">
                                    <span class="input-group-text ">+</span>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="card-header"><h5>Ticket Quantity</h5></div>
                            <div class="input-group" style="width: 150px;">
                                <div class="input-group-prepend decrement" data-servicenameid="26" style="cursor:pointer">
                                    <span class="input-group-text ">-</span>
                                </div>
                                <input type="number" wire:keyup="updateQty($event.target.value,'26')" name="qty[26][ ]" value="1" class="form-control text-center">
                                <div class="input-group-append increment" data-servicenameid="26" style="cursor:pointer">
                                    <span class="input-group-text ">+</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <g>
                                <g>
                                    <path class="st0" d="M248.1,342.2h-0.4c-0.2,0.5-0.6,0.8-1.1,0.8c-0.3,0-0.5-0.1-0.7-0.2c-0.2-0.1-0.3-0.4-0.4-0.6
                                        c-0.1-0.3-0.1-0.9-0.1-0.9l0.2-1.2h0.1v-0.3h0.1V339c0,0-0.1-0.4-0.5-0.5c-0.4-0.1-13.5-4.1-13.5-4.1h-0.8v5.5h0.2v0.6h0.1
                                        c0,0,1,1.4-0.1,2.5h-0.3v-0.6h-1.2v0.6h-0.3c-1.1-1.1-0.1-2.5-0.1-2.5h0.1V340h0.1v-5.5h-0.8c0,0-13.1,4-13.5,4.1
                                        c-0.4,0.1-0.5,0.5-0.5,0.5v0.7h0v0.3h0.1l0.2,1.2c0,0,0,0,0,0.1c0,0.2,0,0.6-0.1,0.8c-0.1,0.5-0.6,0.8-1.1,0.8
                                        c-0.5,0-1-0.4-1.1-0.8H212c0,0-0.2-1.3,0.8-1.6l0-0.5h0.2v-0.3h0.1v-2l15.5-6.5v-1.4h-0.1v-1.7h0.7v-5.9h-0.6l-0.3-0.9l-10.3-0.9
                                        l-2.7-0.2c0,0-0.4,0-0.4-0.5c0-0.6,0-11.2,0-11.2s0-1-0.6-1l-0.8-0.1v-0.7h-0.3v-0.3c0-0.6,0.5-1,1-1h1.1c0.6,0,1,0.5,1,1v0.3
                                        h-0.3v11c0,0-0.2,1.2,0.7,1.3h1.1v-0.3l0.2-0.2c-0.3-0.1-0.5-0.4-0.7-0.8c-0.3-0.1-0.2-0.4-0.2-0.4s1.4-19.7,1.5-21.3
                                        c0.1-1.6,1.5-1.7,1.5-1.7l9.5-0.1h0.1l9.5,0.1c0,0,1.3,0.1,1.5,1.7c0.1,1.6,1.5,21.3,1.5,21.3s0.1,0.3-0.2,0.4
                                        c-0.1,0.4-0.4,0.6-0.7,0.8l0.2,0.2v0.3h1.1c0.9-0.1,0.7-1.3,0.7-1.3v-11h-0.3v-0.3c0-0.6,0.5-1,1-1h1.1c0.6,0,1,0.5,1,1v0.3h-0.3
                                        v0.7l-0.8,0.1c-0.6,0-0.6,1-0.6,1s0,10.7,0,11.2c0,0.6-0.4,0.5-0.4,0.5l-2.7,0.2l-10.2,0.9l-0.4,0.9h-0.6v5.9h0.8v1.7h-0.1v1.4
                                        l15.5,6.5v2h0.1v0.3h0.2l0,0.5C248.2,340.9,248.1,342.2,248.1,342.2z"/>
                                    <path class="st1" d="M239.5,296.3c0-0.2-0.1-0.3-0.1-0.3l-9.4-0.1l-9.5,0.1c0,0-0.1,0.1-0.1,0.3c-0.1,1.2-1,13.1-1.3,18.6h21.8
                                        C240.4,309.4,239.6,297.5,239.5,296.3z"/>
                                    <path class="st0" d="M240.9,317.2l-1.8,0.9l1.1,1.1l-9.6,0.8l-0.3,0.9h-0.6l-0.3-0.8l-9.7-0.9l1-1.1l-1.8-0.9l-0.1-0.3
                                        c0-0.5,0.1-1.2,0.1-2.1h21.8c0.1,0.9,0.1,1.6,0.1,2.1L240.9,317.2z"/>
                                </g>
                                <g>
                                    <text transform="matrix(1 0 0 1 224.7993 310.6563)" class="st2 st3">A2</text>
                                </g>
                            </g>
                        </div>

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


        function selectedDate(date, here) {
            // console.log(date, );
            $(here).parent('div').find('.tb-active').removeClass('tb-active')
            $(here).toggleClass('tb-active');
            @this.set('selectedDate', date);
        }
    </script>
@endpush
