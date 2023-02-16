@extends('backend.layout.app')
@push('css')


@endpush

@section('page-header')
    <i class="fa fa-list"></i> Appointment List
@stop
@section('content')

{{-- @include('backend._partials.page_header', [
    'fa' => 'fa fa-plus-circle',
    'name' => 'Create Appointment',
    'route' => route('backend.appointment.create')
 ]) --}}
 @include('backend._partials.modal_page_header', [
'fa' => 'fa fa-plus-circle',
'name' => 'Create Appointment',
'modelName' => 'create_data',
'route' => route('backend.appointment.create')
])

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table

                        class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sl.</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Designation</th>
                                <th class="text-center">Created By</th>
                                <th class="text-center">Status</th>
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

{{-- modal --}}
<div class="modal fade appointment_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg"" role=" document">
        <div class="modal-content">
            <form class="needs-validation" id="category_add_form" action="{{ route('backend.itemconfig.category.store') }}" method="Post"
                enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="modal-header">
                    <h4 class="title" id="">Category Add</h4>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <div class="row">
                            <div class="col-3">
                                @include('components.backend.forms.select2.option', [
                                    'name' => 'Doctor',
                                    'optionDatas' => [],
                                ])
                            </div>
                            <div class="col-3">
                                @include('components.backend.forms.input.input-type', [
                                    'name' => 'Doctor Fees',
                                    'readonly' => 'true',
                                    'value' => 500,
                                ])
                            </div>
                            <div class="col-3">
                                @include('components.backend.forms.input.input-type', [
                                    'name' => 'Appointment Date',
                                    'type' => 'date',
                                ])
                            </div>
                            <div class="col-3">
                                @include('components.backend.forms.select2.option', [
                                    'name' => 'Slot',
                                    'optionDatas' => [],
                                    'required' => 'true',
                                ])
                            </div>
                            <div class="col-3">
                                @include('components.backend.forms.select2.option', [
                                    'name' => 'Appointment Priority',
                                    'optionDatas' => [],
                                    'required' => 'true',
                                ])
                            </div>
                            <div class="col-3">
                                @include('components.backend.forms.select2.option', [
                                    'name' => 'Payment Method',
                                    'optionDatas' => [],
                                    'required' => 'true',
                                ])
                            </div>
                            <div class="col-3">
                                @include('components.backend.forms.select2.option', [
                                    'name' => 'Status',
                                    'optionDatas' => [],
                                    'required' => 'true',
                                ])
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary save_category_button">SAVE</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('js')


    <script>
         $('#create_data').click(function(e) {
            e.preventDefault();
            var modal = ".appointment_modal";
            $(modal).modal('show');
            // var href = $(this).data('href');
            // AJAX request
            // $.ajax({
            //     url: href,
            //     type: 'GET',
            //     dataType: "html",
            //     success: function(response) {
            //         $(modal).modal('show');
            //         $(modal).find('.modal-dialog').html('');
            //         $(modal).find('.modal-dialog').html(response); // Add response in Modal body
            //     }
            // });
        });

    </script>


@endpush
