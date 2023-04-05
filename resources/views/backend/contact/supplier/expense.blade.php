@extends('backend.layout.app')
@include('backend._partials.datatable__delete')


@section('page-header')
<i class="fa fa-plus-circle"></i> Supplier Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Supplier List',
'route' => route('backend.supplier.index')
])

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

<div class="card border-top">
    <div class="body">
        <h4 class="pointer text-info" id="toggleFilter">
            <i class="fa fa-filter"></i> Filter
        </h4>
        <div id="filterContainer">
            <hr>
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        @include('components.backend.forms.select2.option',[ 'name' => 'business_location', 'required'=>true, 'optionData' => [] ])
                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        @include('components.backend.forms.select2.option',[ 'name' => 'expense_for', 'required'=>true, 'optionData' => [] ])
                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        @include('components.backend.forms.select2.option',[ 'name' => 'contact', 'required'=>true, 'optionData' => [] ])
                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        @include('components.backend.forms.select2.option',[ 'name' => 'expense_category
                        ', 'required'=>true, 'optionData' => [] ])
                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        @include('components.backend.forms.select2.option',[ 'name' => 'sub_category
                        ', 'required'=>true, 'optionData' => [] ])
                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <label class="col-form-label">
                            Date Range:
                        </label>
                        <input type="text" id="dateRangePicker" name="dates" class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        @include('components.backend.forms.select2.option',[ 'name' => 'payment_status
                        ', 'required'=>true, 'optionData' => [] ])
                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="card border-top">
    <div class="body">
        <h6 class="mb-4"> All Expenses</h6>
        <table ellspacing='0' style="width: 100% !important;" class="table table-bordered text-center dataTable w-full" id="supplier_table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Reference No</th>
                    <th>Recurring details</th>
                    <th>Expense Category</th>
                    <th>Sub Category</th>
                    <th>Location</th>
                    <th>Payment Status</th>
                    <th>Tax</th>
                    <th>Total Amount</th>
                    <th>Payment Due</th>
                    <th>Expense For</th>
                    <th>Contacts</th>
                    <th>Expense Notes</th>
                    <th>Added By</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>


@endsection

@push('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    let table_name = $("#supplier_table");
    $(function() {
        table_name.DataTable({
            dom: "Bfrtip",
            buttons: ["colvis", "copy", "csv", "excel", "pdf", "print",
                {
                    text: 'Reload',
                    action: function(e, dt, node, config) {
                        table_name.DataTable().ajax.reload();
                    }
                }
            ],
            processing: true,
            serverSide: true,
            destroy: true,
            pagingType: 'numbers',
            pageLength: 10,
            ajax: "{{ route('backend.supplier.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'mobile',
                    name: 'mobile'
                },
                {
                    data: 'email',
                    name: 'email'
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

    $(document).ready(() => {
        $('#dateRangePicker').daterangepicker();
    })
</script>
@endpush
