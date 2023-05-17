@extends('backend.layout.app')
@push('css')
@endpush
@section('page-header')
    <i class="fa fa-plus-circle"></i> Lab Report
@stop

@section('content')
<form action="{{ route('backend.pathology.make-test-result-store') }}" method="post">
    @csrf
    @method('POST')
    <input type="hidden" name="lab_invoice_test_detail_id" value="{{ $data['labDetails_id'] }}">
    <input type="hidden" name="test_id" value="{{ $data['labTest_id'] }}">
    <div class="card">
        <div class="body">
            <h3 class="text-center mb-5">
                <i class="fa fa-flask"></i> Biochemistry Report
            </h3>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [

                        'name' => 'name[]',
                        'value' => 'Hemoglobin (Hb)',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => 'g/dl',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => 'Male: 13-17
                        Female: 12.0-16.5
                        1 Month: 11-17, 2-6 Month:9.5-13.5
                        2-6 Years: 11-14, 6-12 Years:11.5-15.5',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'ESR (Westergreen)',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => 'mm/1st hr',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => 'Male: 0.10, Female: 0.20',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'Total WBC Count (TC)',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => 'cumm',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => 'Adult:4,000-11,000
                            Infant: 6,000-18,000
                            Child: 5,000-15,000
                            At Birth: 10,000-25,000',
                    ])
                </div>
            </div>
            <h6 class="my-2">
                Differential WBC Count (DC)
            </h6>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'Neutrophils',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => '%',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => 'Adult:40-75 ,Child:20-50',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'Lymphocytes',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => '%',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => 'Adult:20-50 ,Child:40-75',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'Monocytes',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => '%',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => '2-10',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'Eosinophils',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => '%',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => '2-6',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'Basophils',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => '%',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => '<1.0',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'Total Cir. Eosinophils',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => 'Cumm',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => '50-500',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'Total RBC Count',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => 'm/ul',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => 'Male: 4.5-6.5, Female: 3.8-5.8',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'HCT/PCV',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => '%',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => 'Male: 40-54, Female: 37-47',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'MCV',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => 'fL',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => '76-94',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'MCH',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => 'Pg',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => '27-32',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'MCHC',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => 'g/dl',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => '29-34',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'RDW-CV',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => '%',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => '11-16',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'RDW-SD',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => 'fL',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => '35-56',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'PDW',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => 'fL',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => '11.00-22.00',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'Total Platelet Count',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => 'Cmm',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => '1,50,000-4,50,000',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'MPV',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => 'fL',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => '7-11',
                    ])
                </div>
            </div>
            <div class="row mb-2 align-items-center">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name[]',
                        'value' => 'PCT',
                    ])
                </div>
                <div class="col-2">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                    ])
                </div>
                <div class="col-1">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'unit[]',
                        'value' => '%',
                    ])
                </div>

                <div class="col-6">
                    @include('components.backend.forms.texteditor.editor', [
                        'name' => 'reference_value[]',
                        'value' => '0.1-0.2',
                    ])
                </div>
            </div>

            <div class="row text-right">
                <div class="col-12">
                    <button class="btn btn-primary btn-md" type="submit">Save</button>
                </div>

            </div>
        </div>
    </div>

</form>

@endsection

@push(' js')
@endpush
