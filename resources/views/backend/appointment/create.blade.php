@extends('backend.layout.app')
@push('css')
@endpush
@section('page-header')
    <i class="fa fa-plus-circle"></i> Appointment Create
@stop

@section('content')
    @include('backend._partials.page_header', [
        'fa' => 'fa fa-list',
        'name' => 'Appointment List',
        'route' => route('backend.siteconfig.slider.index'),
    ])
    <div class="card">
        <div class="body">
            <div class="row">
                <div class="col-3">
                    @include('components.backend.forms.select2.option', [
                        'name' => 'doctor',
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



@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $image = $('#userProfile');
            $imageFile = $('#userProfile-image');
            // Grab image link when input change
            $image.change(function() {
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $imageFile.attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>
@endpush
