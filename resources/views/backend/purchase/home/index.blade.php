@extends('backend.layout.app')
@include('backend._partials.datatable__delete')
@push('css')

@endpush

@section('page-header')
<i class="fa fa-list"></i> Purchase List
@stop

@section('table_header')
@include('backend._partials.page_header', [
'fa' => 'fa fa-plus-circle',
'name' => 'Create Purchase',
'route' => route('backend.purchase.create')
])

@stop
@section('content')


<div class="row">
    <div class="col-lg-12">
      
        <div class="card">
            {{-- <div class="body">
                <h4 class="pointer text-info" id="toggleFilter">
                    <i class="fa fa-filter"></i> Filter
                </h4>
                <div id="filterContainer">
                    <hr>
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                @include('components.backend.forms.select2.option',[ 'label'=> 'Puchase status', 'name' => 'status','onchange'=>true,  'optionDatas' => $status ])
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="card border-top">
            @yield('table_header')
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center dataTable" id="purchase_table">
                        <thead>
                            <tr>
                                {{-- <th class="text-center">SI No.</th> --}}
                                <th class="text-center">Invoie No.</th>
                                <th class="text-center">Supplier</th>
                                <th class="text-center">Warehouse</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Purchase Status</th>
                                <th class="text-center">Payment Status</th>
                                <th class="text-center">Paid Amount</th>
                                <th class="text-center">Due Amount</th>
                                <th class="text-center">Sub Total</th>
                                <th class="text-center">Total </th>
                                {{-- <th class="text-center">Action</th> --}}
                                <th class="text-center">Action</th>
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



@endsection

@push('js')

<script>
    let table_name ;
    var modal = ".purchase_modal";
$(function() {
        table_name =$("#purchase_table").DataTable({
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
            ajax: "{{ route('backend.purchase.index') }}",
            ajax: {
                method:'GET',
                url : "{{ route('backend.purchase.index') }}",
                data : function ( d ) {
                    d.status = $('select#status').val()||true;
                },
            },
            columns: [
               
                {
                    data: 'invoice_number',
                    name: 'invoice_number'
                }, 
                {
                    data: 'supplier_id',
                    name: 'supplier_id'
                }, 
                {
                    data: 'warehouse_id',
                    name: 'warehouse_id'
                }, 
                {
                    data: 'purchase_date',
                    name: 'purchase_date',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'purchase_status',
                    name: 'purchase_status',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'payment_status',
                    name: 'payment_status',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'paid_amount',
                    name: 'paid_amount'
                },
                {
                    data: 'due_amount',
                    name: 'due_amount'
                },
                {
                    data: 'subtotal_amount',
                    name: 'subtotal_amount'
                },
                {
                    data: 'total_amount',
                    name: 'total_amount'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });
    });


    

    $('#toggleFilter').click(() => {
        $('#filterContainer').slideToggle();
    })
    function dataBaseCall(){  
        table_name.ajax.reload();
    }

   
    
</script>


@endpush