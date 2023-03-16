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
                        // 'label' => 'doctor name',
                        'name' => 'doctor',
                        'optionDatas' => [],
                    ])
                </div>
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'Doctor Fees',
                        'readonly' => 'true',
                        'value' => 5000,
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
                {{-- <div class="col-3">
                    @include('components.backend.forms.select2.option', [
                        'name' => 'Appointment Priority',
                        'optionDatas' => [],
                        'required' => 'true',
                    ])
                </div> --}}
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
@endpush