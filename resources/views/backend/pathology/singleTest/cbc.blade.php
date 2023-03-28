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

    <form action="{{ route('backend.pathology.make-test-result-store') }}" method="post">
        @csrf
        @method('POST')
        <input type="hidden" name="lab_invoice_test_detail_id" value="{{ $labInvoiceTestDetail->id }}">
        <div class="card">
            <div class="body">
                <h5 class="mb-3">
                    <i class="fa fa-flask"></i> Hematology Report
                </h5>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Hemoglobin (Hb)',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">Male: 13-17
                        Female: 12.0-16.5
                        1 Month: 11-17, 2-6 Month:9.5-13.5
                        2-6 Years: 11-14, 6-12
                        Years:11.5-15.5
                    </textarea>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'ESR (Westergreen)',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">Male: 0.10, Female: 0.20</textarea>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Total WBC Count (TC)',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">Adult:4,000-11,000
                            Infant: 6,000-18,000
                            Child: 5,000-15,000
                            At Birth: 10,000-25,000
                        </textarea>
                    </div>
                </div>

                <h6 class="mt-4 mb-2">
                    Diﬀerential WBC Count (DC)
                </h6>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Neutrophils',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">Adult:40-75 ,Child:20-50</textarea>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Lymphocytes',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">Adult:20-50 ,Child:40-75</textarea>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Monocytes',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">2-10</textarea>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Eosinophils',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">2-6</textarea>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Basophils',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">{{ '<1.0' }}
                </textarea>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Total Cir. Eosinophils',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">50-500</textarea>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Total RBC Count',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">Male: 4.5-6.5, Female: 3.8-5.8</textarea>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'HCT/PCV',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">Male: 40-54, Female: 37-47</textarea>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'MCV',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">76-94</textarea>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'MCH',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">27-32</textarea>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'MCHC',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">29-34</textarea>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'RDW-CV',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">11-16</textarea>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'RDW-SD',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">35-56</textarea>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'PDW',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">11.00-22.00</textarea>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Total Platelet Count',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="referance[]" id="" rows="1">1,50,000-4,50,000</textarea>
                    </div>
                </div>
            </div>
        </div>


    </form>

    @endsection

    @push('js')
    @endpush
