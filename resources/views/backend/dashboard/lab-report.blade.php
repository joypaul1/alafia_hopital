@extends('backend.layout.app')
@push('css')
@endpush
@section('page-header')
<i class="fa fa-plus-circle"></i> Lab Report
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Report Pages',
'route' => route('backend.siteConfig.slider.index'),
])
<div class="card">
    <div class="body">
        <h6>
            <i class="fa fa-flask"></i> Biochemistry Report
        </h6>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'Fasting Blood Sugar (FBS)',
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'result[]',
                'placeholder' => 'Enter result here...',
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.select2.option2', [
                'name' => 'unit[]',
                'optionDatas' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'reference[]',
                'required' => true,
                'value' => '3.5 – 5.5'
                ])
            </div>
        </div>
    </div>
</div>



@endsection

@push(' js') @endpush
