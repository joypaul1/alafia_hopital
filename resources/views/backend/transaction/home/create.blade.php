@extends('backend.layout.app')
@push('css')

@endpush
@section('page-header')
<i class="fa fa-plus-circle"></i> Transaction Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Transaction List',
'route' => route('backend.account.transaction.index')
])

<div class="row">
    <div class="col-lg-12">
        <form class="needs-validation" action="{{ route('backend.account.transaction.store') }}" method="Post"
            enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="card border-top">
                <div class="card-body">
                    <div class="form-validation">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="col-form-label">
                                    Date: <span class="text-danger">*</span>
                                </label>
                                <div class="input-group mb-3">
                                    <div class="input-gproup-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="date" placeholder="date" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="discount_amount">
                                        Invoice Number
                                    </label>
                                    <input type="text" value="{{$invoice_number}}"  class="form-control"name="invoice_number" readonly title="invoice_number">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-top">

                <div class="body">
                    <h3 class="mb-3 text-center">Transation ledger</h3>
                    <hr>
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-4">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'ledger', 'placeholder'
                            => 'Enter Ledger Name here...',  ])
                            @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('ledger')])
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table-material" ellspacing='0' class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th> Ledger Name</th>
                                    <th> Debit / Credit</th>
                                    <th> Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr></tr>

                            </tbody>
                        </table>
                    </div>
                    <div>
                        <label class="col-form-label" for="description">Description</label>
                        <textarea class="form-control " name="description" id="description" cols="100" rows="5"></textarea>
                    </div>
                </div>

                <input type="hidden" name="debit_total" id="debit_total" value="0">
            </div>
            <div class="form-group">
                @include('components.backend.forms.input.submit-button',['disabled'=> true, 'id' => 'submit'])
            </div>
        </form>
    </div>
</div>


@endsection

@push('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
      $(function() {

        $("#ledger").autocomplete({
            source: function(request, response) {
                var optionData = request.term;
                $.ajax({
                    method: 'GET',
                    url: "{{ route('backend.account.accountledger.index') }}",
                    data: {'optionData': optionData},
                    success: function(res) {
                        var resArray = $.map(res.data, function(obj) {
                            return {
                                value:  obj.name, //Fillable in input field
                                value_id:  obj.id, //Fillable in input field
                                label: obj.name  //Show as label of input fieldname: obj.name
                            }
                        })
                        response(resArray);
                    }
                });
            }
            , minLength: 1
            , select: function(event, ui) {
                //  data
                var res = '<tr id="">' +
                    '<td>' +
                    ui.item.value +
                    '<input type="hidden" name="ledger_id['+ui.item.value_id+']" value="' + ui.item.value_id + '">' +
                    '</td>' +
                    '<td>' +
                    '<select id="ledger_type" name="ledger_type['+ui.item.value_id+']" class="form-control">' +
                    '<option value="debit">Debit</option>' +
                    '<option value="credit">Credit</option>' +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" id="amount" name="amount['+ui.item.value_id+']" class="form-control" placeholder="Amount here...">' +
                    '</td>' +
                    '</tr>';
                $('table#table-material>tbody>tr:first').after(res);
                calculation();
            }
        });

        function calculation(){
            var debit = credit = 0;
            $("table#table-material>tbody>tr>td input[id='amount']").each(function(){
                let type= $(this).closest('tr').find('select[id="ledger_type"]').val();
                if(type == 'debit'){
                    debit += Number($(this).val());
                }
                if(type == 'credit'){
                    credit += Number($(this).val());
                }
            });
            // console.log(debit ,credit,debit == credit);
            $('#debit_total').val(debit);
            if(debit == credit){
                $('#submit').attr('disabled', false);
            }else{
                $('#submit').attr('disabled', true);
            }

        }
        $(document).on('change','table#table-material>tbody>tr>td select[id="ledger_type"]', function(){
            calculation();
        });

        $(document).on('keyup','table#table-material>tbody>tr>td input[id="amount"]', function(){
            calculation();
        });

    });


</script>
@endpush
