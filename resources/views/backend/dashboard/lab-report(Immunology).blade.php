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
        <h5 class="mb-3">
            <i class="fa fa-flask"></i> Immunology Report
        </h5>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'T3',
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'result[]',
                'placeholder' => 'Enter result here...',
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.select2.option2', [
                'name' => 'unit[]',
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'ng/ml'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Adult: 0.8 - 2.0
Child:1.06 - 2.89
Infant: 1.25 - 5.49
Newborn: 1.19 - 7.71</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'T4',
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'result[]',
                'placeholder' => 'Enter result here...',
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.select2.option2', [
                'name' => 'unit[]',
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'µg/dl'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Adult: 5.1- 14.1
Child: 6.1- 15.3
Infant: 7.7 - 20.1
Newborn: 12.3 - 26.2</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'TSH',
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'result[]',
                'placeholder' => 'Enter result here...',
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.select2.option2', [
                'name' => 'unit[]',
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mlu/L'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Adult: 0.3 - 4.2
Pediatric:
1-4 days: 2.65 - 25.2
4-30 days: 1.15 - 11.9
1-12 mon: 0.55 - 6.0
1-5 yrs :0.65 - 5.3
6-10 yrs: 0.75 - 4.7
11-18 yrs: 0.55 - 4.5
Pregnancy:
1st trimester: 0.01 - 2.47
2nd trimester: 0.25 - 1.91
3rd trimester: 0.55 - 3.2</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'Free T3',
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'result[]',
                'placeholder' => 'Enter result here...',
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.select2.option2', [
                'name' => 'unit[]',
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'pg/mL'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Adult: 1.8 - 4.6
Pediatric:
1-4 days:1.3 - 8.0
4-30 days: 2.43 - 5.48
1-12 mon: 2.17 - 5.61
1-5 yrs :2.23 - 5.0
6-10 yrs: 2.23 - 5.09
11-18 yrs: 2.17 - 5.02</textarea>
            </div>
        </div>
    </div>
</div>



@endsection

@push('js') @endpush
