@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@section('page-header')
    <i class="fa fa-list"></i> Rack List
@stop
@section('content')



@include('backend._partials.modal_page_header', [
'fa' => 'fa fa-plus-circle',
'name' => 'Create Rack',
'modelName' => 'create_data',
'route' => route('backend.itemconfig.rack.create')
])


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table ellspacing='0' class="table table-bordered text-center dataTable rack_table">
                        <thead>
                            <tr>
                                <th> Sl.</th>
                                <th> Name</th>
                                <th> Note</th>
                                <th> Status</th>
                                <th> Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade add_modal"  tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg"" role="document">
        
    </div>
</div>
@endsection

@push('js')
<script>
    let table_name =  $(".rack_table");
    var modal = ".add_modal";
    $(function () {
        table_name.DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print"],
            processing: true,
            serverSide: true,
            destroy: true,
            pageLength: 10,
            ajax: "{{ route('backend.itemconfig.rack.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'note', name: 'note' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },  
            ],
        });
    });

    $('#create_data').click(function(e) {
        e.preventDefault();
       
        var href = $(this).data('href');
        // AJAX request
        $.ajax({
            url: href, type: 'GET', dataType: "html",
            success: function(response) {
                $(modal).modal('show');
                $(modal).find('.modal-dialog').html('');
                $(modal).find('.modal-dialog').html(response);// Add response in Modal body

            }
        });
    });
    $(document).on('click', 'button.edit_data', function(e){
        e.preventDefault();
        var href = $(this).data('href');
        // AJAX request
        $.ajax({
            url: href, type: 'GET', dataType: "html",
            success: function(response) {
                $(modal).modal('show');
                $(modal).find('.modal-dialog').html('');
                $(modal).find('.modal-dialog').html(response);// Add response in Modal body

            }
        });
    })


    $(document).on('submit', 'form#rack_edit_form', function(e) {
        e.preventDefault();

        var registerForm = $("form#rack_edit_form");
        var formData = registerForm.serialize();
        $('.edit_rack_button').attr('disabled',true);
        $.ajax({
            enctype: 'multipart/form-data',
            url: $(this).attr('action'),
            type: 'PUT',
            data: formData,
            success: function(res) {
                if(res.status){
                    $(modal).modal('hide');
                    let $message = "Add Successfully";
                    let $context = 'success';
                    let $positionClass= 'toast-top-right';
                    toastr.remove();
                    toastr[$context]($message, '', {
                        positionClass: $positionClass
                    });
                 
                    table_name.DataTable().ajax.reload()
                }else{
                    let $message =res.error;
                    let $context = 'error';
                    let $positionClass= 'toast-top-right';
                    toastr.remove();
                    toastr[$context]($message, '', {
                        positionClass: $positionClass
                    });
                }
            },
        });
    });
    $(document).on('submit', 'form#rack_add_form', function(e) {
        e.preventDefault();

        var registerForm = $("form#rack_add_form");
        var formData = registerForm.serialize();
        $('.save_rack_button').attr('disabled',true);
        $.ajax({
            enctype: 'multipart/form-data',
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            success: function(res) {
                if(res.status){
                    $(modal).modal('hide');
                    let $message = "Add Successfully";
                    let $context = 'success';
                    let $positionClass= 'toast-top-right';
                    toastr.remove();
                    toastr[$context]($message, '', {
                        positionClass: $positionClass
                    });
                 
                    table_name.DataTable().ajax.reload()
                }else{
                    let $message =res.error;
                    let $context = 'error';
                    let $positionClass= 'toast-top-right';
                    toastr.remove();
                    toastr[$context]($message, '', {
                        positionClass: $positionClass
                    });
                }
            },
        });
    });
   
</script>
@endpush