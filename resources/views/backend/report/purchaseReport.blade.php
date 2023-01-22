@extends('backend.layout.app')
@include('backend._partials.datatable__delete')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/backend/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
@endpush

@section('page-header')
<i class="fa fa-list"></i> Purchase Report
@stop

@section('table_header')
{{-- @include('backend._partials.page_header', [
'fa' => 'fa fa-list',
// 'name' => 'Create Order',
// 'modelName' => 'create_data',
'route' => route('backend.order.order-list.index')
]) --}}

@stop
@section('content')


<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="body">
                <h4 class="pointer text-info" id="toggleFilter">
                    <i class="fa fa-filter"></i> Filter
                </h4>
                <div id="filterContainer">
                    <hr>
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                                @include('components.backend.forms.select2.option',[ 'label'=> 'status', 'name' => 'status','onchange'=>true,  'optionDatas' => $status ])
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <label>Start Date</label>
                            <div class="input-group mb-3">
                                <input  value="{{date('y-m-d')}}" autocomplete="off" data-provide="datepicker" data-date-autoclose="true" id="start_date"  name="start_date" class="form-control">

                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <label>End Date</label>
                            <div class="input-group mb-3">
                                <input value="{{date('y-m-d')}}"  autocomplete="off" data-provide="datepicker" data-date-autoclose="true" id="end_date"  name="end_date" class="form-control">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-top">
            @yield('table_header')
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center dataTable" id="Order_table">
                        <thead>
                            <tr>
                                <th class="text-center">Sl.</th>
                                <th class="text-center">Date </th>
                                <th class="text-center">Order Type</th>
                                <th class="text-center">Item Qty</th>
                                <th class="text-center">Sub Total</th>
                                <th class="text-center">Vat</th>
                                <th class="text-center">Total</th>
                                {{-- <th class="text-center">Paid By</th>
                                <th class="text-center">Created By</th> --}}
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal HTML -->

<div class="modal fade Order_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg"" role=" document">

    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/backend/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>



<script>
    let table_name ;
    var modal = ".Order_modal";
    $(function() {
        table_name =$("#Order_table").DataTable({
            dom: "Bfrtip",
            buttons: ["colvis","copy", "csv", "excel", "pdf", "print",
                {
                    text: 'Reload',
                    action: function ( e, dt, node, config ) {
                        dataBaseCall();
                    }
                }
            ],
            processing: true,
            serverSide: true,
            destroy: true,
            pagingType: 'numbers',
            pageLength: 10,
            ajax: "{{ route('backend.report.sellReport') }}",
            ajax: {
                method:'GET',
                url : "{{ route('backend.report.sellReport') }}",
                data : function ( d ) {
                    d.status = $('select#status').val()||true;
                    d.start_date = $('#start_date').val()||true;
                    d.end_date = $('#end_date').val()||true;
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'order_type',
                    name: 'order_type'
                },
                {
                    data: 'item_qty',
                    name: 'item_qty'
                },
                {
                    data: 'sub_total',
                    name: 'sub_total'
                },
                {
                    data: 'vat',
                    name: 'vat'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                // {
                //     data: 'paymentHistories',
                //     name: 'paymentHistories',
                // },
                // {
                //     data: 'created_by',
                //     name: 'created_by',
                //     orderable: false,
                //     searchable: false
                // },
            ],
        });
    });



    $('#toggleFilter').click(() => {
        $('#filterContainer').slideToggle();
    })
    function dataBaseCall(){
        table_name.ajax.reload();
    }

    $(document).on('change', '#status', function () {
        dataBaseCall();
    });
    $(document).on('change', '#start_date', function () {
        console.log($('#start_date').val());
        dataBaseCall();
    });
    $(document).on('change', '#end_date', function () {
        dataBaseCall();
    });


</script>


@endpush
