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
            <i class="fa fa-flask"></i> Serology Report
        </h5>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'Blood Group',
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'result[]',
                'placeholder' => 'Enter result here...',
                ])
            </div>
            <div class="col-6">
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'Rh (D) Factor',
                ])
            </div>
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'result[]',
                'placeholder' => 'Enter result here...',
                ])
            </div>
            <div class="col-6">
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'HBs Ag (ICT)',
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
                'optionDatas' => $units,
                'required' => true,
                'selectedKey' => 'N/A'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Negative / Positive</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'Anti- HCV (ICT)',
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
                'optionDatas' => $units,
                'required' => true,
                'selectedKey' => 'N/A'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Negative / Positive</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'Anti- HIV 1+2 (ICT)',
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
                'optionDatas' => $units,
                'required' => true,
                'selectedKey' => 'N/A'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Negative / Positive</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'Syphilis Test (ICT)',
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
                'optionDatas' => $units,
                'required' => true,
                'selectedKey' => 'N/A'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Negative / Positive</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'C-reactive Protein ( CRP )',
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
                'optionDatas' => $units,
                'required' => true,
                'selectedKey' => 'mg/L'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">< 6</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'ASO',
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
                'optionDatas' => $units,
                'required' => true,
                'selectedKey' => 'IU/mL'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">< 200</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'RA / RF',
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
                'optionDatas' => $units,
                'required' => true,
                'selectedKey' => 'N/A'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Negative / Positive</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'VDRL (Qualitative)',
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
                'optionDatas' => $units,
                'required' => true,
                'selectedKey' => 'N/A'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Negative / Positive</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'Malaria (ICT)',
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
                'optionDatas' => $units,
                'required' => true,
                'selectedKey' => 'N/A'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Negative / Positive</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'H. Pylori Ab (ICT)',
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
                'optionDatas' => $units,
                'required' => true,
                'selectedKey' => 'N/A'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Negative / Positive</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'Dengue Ns1',
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
                'optionDatas' => $units,
                'required' => true,
                'selectedKey' => 'N/A'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Negative / Positive</textarea>
            </div>
        </div>
        <h6 class="mt-4 mb-3">
            <u>
                Dengue Ns1
            </u>
        </h6>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'IgM',
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
                'optionDatas' => $units,
                'required' => true,
                'selectedKey' => 'N/A'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Negative / Positive</textarea>
            </div>
        </div>
        <hr>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'Urine for Pregnancy test (PT)',
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
                'optionDatas' => $units,
                'required' => true,
                'selectedKey' => 'N/A'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Negative / Positive</textarea>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3">
                @include('components.backend.forms.input.input-type2', [
                'name' => 'name[]',
                'value' => 'Occult Blood Test',
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
                'optionDatas' => $units,
                'required' => true,
                'selectedKey' => 'N/A'
                ])
            </div>
            <div class="col-3">
                <textarea class="form-control" name="referance[]" id="" rows="1">Negative / Positive</textarea>
            </div>
        </div>
    </div>
</div>



@endsection

@push('js') @endpush
