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
                'optionData' => $units,
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
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'CUS',
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
                'optionData' => $units,
                'required' => true,
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'reference[]',
                'required' => true,
                'value' => 'Nil'
                ])
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'Blood Glucose 2 Hrs. AFB',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mmol/l'
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'reference[]',
                'required' => true,
                'value' => '< 7.8 '
                ])
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include(' components.backend.forms.input.input-type2', [ // 'label'=> 'doctor name',
                    'name' => 'name[]',
                    'value' => 'Blood Glucose 2 Hrs. After 75gm Glucose',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mmol/l'
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'reference[]',
                'required' => true,
                'value' => '< 7.8 '
                ])
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include(' components.backend.forms.input.input-type2', [ // 'label'=> 'doctor name',
                    'name' => 'name[]',
                    'value' => 'Random Blood Sugar (RBS)',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mmol/l'
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'reference[]',
                'required' => true,
                'value' => '< 7.8 '
                ])
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include(' components.backend.forms.input.input-type2', [ // 'label'=> 'doctor name',
                    'name' => 'name[]',
                    'value' => 'S. Urea',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'reference[]',
                'required' => true,
                'value' => '15 – 40'
                ])
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'S. BUN',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'reference[]',
                'required' => true,
                'value' => '7 - 23'
                ])
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'S. Creatinine',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'reference[]',
                'required' => true,
                'value' => '0.7 – 1.3 '
                ])
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'S. Iron',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Adult: 0.3-12

                    New born: 0.5 – 10 Male:49-181
                    Female: 37-170
                    Child: 50-120
                    Newborn: 100-250</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'S. T.I.B.C',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'µg/dl'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">255-450</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'S. Bilirubin ( Total )',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Adult: 0.3-12
New born: 0.5 – 10</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'S. Bilirubin ( Direct )',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Up to 0.25 </textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'S. Bilirubin ( Indirect )',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Up to 12 </textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'SGOT ( AST )',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'U/L'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Up to 35</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'SGPT ( ALT )',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'U/L'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Up to 40</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'Alkaline Phosphates',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'U/L'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Children: (1-14 Yrs) up to 645</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'S. Albumin',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'g/dl'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">3.5 – 4.0</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'S. Protein ( Total )',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">63-82</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'Globulin',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">16-35</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'A/G Ratio',
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
                'optionData' => $units,
                'required' => true,
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">1.2:1 – 2.5:1</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'S. Lipase',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'U/L'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">< 60</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'S. Amylase',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'U/L'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Up to 100 </textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'CK-MB',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'U/L'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Up to 25 </textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'CPK',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'U/L'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Male: 38 – 174
Female : 26 - 140</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'S. Uric Acid',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Male 3.50 – 7.20
Female 2.60 – 6.0 </textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'S. Calcium',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">New born: 7.6-10.4
Adult: 8.6-10.2
Child: 8.8 -10.8 </textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'S. Inorganic Phosphate',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Adult 2.5 – 5.0
Child 4.0 – 7.0 </textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'S. Magnesium',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">1.9 – 2.5 </textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'Sodium (Na+)',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mmol/l'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">132-146</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'Potassium ( K+)',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mmol/l'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">3.50-5.50</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'Chloride ( CL-)',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mmol/l'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">99-109</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'Carbon dioxide ( CO2+)',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mmol/l'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">20-31</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'S. Cholesterol',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">200</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'S. Triglyceride',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">150</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'HDL',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1"> >35 </textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'LDL',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => 'mg/dl'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">< 130</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                // 'label' => 'doctor name',
                'name' => 'name[]',
                'value' => 'HBA 1c',
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
                'optionData' => $units,
                'required' => true,
                'selectedKey' => '%'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">4.8 – 6.0</textarea>
            </div>
        </div>
    </div>
</div>



@endsection

@push(' js') @endpush
