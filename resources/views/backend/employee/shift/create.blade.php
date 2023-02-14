@extends('backend.layout.app')
@push('css')

<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
@endpush
@section('page-header')
<i class="fa fa-plus-circle"></i> Shift Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Shift List',
'route' => route('backend.employee.shift.index')
])
  

<div class="row">
    <div class="col-lg-8">
        <div class="card">
           
            <div class="card-body">
                <div class="form-validation">
                    <form class="needs-validation" action="{{ route('backend.employee.shift.store') }}" method="Post" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="mb-3 row">
                            {{-- <label class="col-lg-4 col-form-label" for="name">Name </label> --}}
                            <div class="col-lg-8">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder' => 'name will be here...', 'required'=> true ,'autocomplete' => false])
                                @include('components.backend.forms.input.errorMessage', ['message' =>  $errors->first('name')])
                            </div>
                        </div>
                        <div class="mb-3 row">
                            {{-- <label class="col-lg-4 col-form-label" for="start_time">Start Time </label> --}}
                            <div class="col-lg-8">
                                <div class="input-group demo-masked-input">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-clock"></i></span>
                                    </div>
                                    <input type="text"name="start_time" class="form-control time12" placeholder="Ex: 10:00 am">
                                </div>
                               
                                @include('components.backend.forms.input.errorMessage', ['message' =>  $errors->first('start_time')])
                            </div>
                        </div>
                     
                        <div class="mb-3 row">
                            <label class="col-lg-4 col-form-label" for="end_time">End Time </label>
                            <div class="col-lg-8">
                                <div class="input-group  demo-masked-input">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-clock"></i></span>
                                    </div>
                                    <input type="text"  name="end_time" class="form-control time12" placeholder="Ex: 06:00 pm">
                                </div>
                                @include('components.backend.forms.input.errorMessage', ['message' =>  $errors->first('end_time')])
                            </div>
                        </div>
                 
                        <div class="mb-3 row">
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

<script src="{{ asset('assets/backend') }}/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script> 
<script src="{{ asset('assets/backend') }}/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>
<script src="{{ asset('assets/backend') }}/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script>
$(function () {
        console.clear();
        console.log('object');

    var $demoMaskedInput = $(".demo-masked-input");
    $demoMaskedInput
        .find(".date")
        .inputmask("dd/mm/yyyy", { placeholder: "__/__/____" });
    $demoMaskedInput
        .find(".time12")
        .inputmask("hh:mm t", {
            placeholder: "__:__ _m",
            alias: "time12",
            hourFormat: "12",
        });
   
});


</script>
@endpush
