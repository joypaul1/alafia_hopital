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
        'route' => route('backend.siteConfig.slider.index'),
    ])
    <div class="card">
        <div class="body">
            <div class="row">
                <div class="col-3">
                    @include('components.backend.forms.select2.option', [
                        'name' => 'doctor',
                        'optionData' => [],
                    ])
                </div>
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'Doctor Fees',
                        'readonly' => 'true',
                        'value' => 6000,
                    ])
                </div>
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'Appointment Date',
                        'inType' => 'date',
                    ])
                </div>
                <div class="col-3">
                    @include('components.backend.forms.select2.option', [
                        'name' => 'Slot',
                        'optionData' => [],
                        'required' => 'true',
                    ])
                </div>

                <div class="col-3">
                    @include('components.backend.forms.select2.option', [
                        'name' => 'Payment Method',
                        'optionData' => [],
                        'required' => 'true',
                    ])
                </div>
                <div class="col-3">
                    @include('components.backend.forms.select2.option', [
                        'name' => 'Status',
                        'optionData' => [],
                        'required' => 'true',
                    ])
                </div>
                <div class="col-4">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'subtotal',
                        'readonly' => 'true',
                    ])
                </div>
                <div class="col-4">
                    @include('components.backend.forms.select2.option', [
                        'name' => 'discount_type',
                        'optionData' => $discountType,
                    ])
                </div>
                <div class="col-4">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'discount',
                        // 'readonly' => 'true',
                        'value' => 0,
                    ])
                </div>
                <div class="col-4">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'discount_amount',
                        'readonly' => 'true',
                        'value' => 0.00,
                    ])
                </div>

                <div class="col-4">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'payable_amount',
                        'readonly' => 'true',
                        'value' => 0.00,
                    ])
                </div>

                {{-- <div class="col-4">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'paid_amount',
                        'value' => 0.00,
                    ])
                </div>
                <div class="col-4">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'due_amount',
                        'readonly' => true,
                        'value' => 0.00,
                    ])
                </div> --}}
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
