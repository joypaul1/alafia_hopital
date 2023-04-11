@extends('backend.layout.app')
@push('css')
@endpush
@section('page-header')
    <i class="fa fa-plus-circle"></i> Lab Report
@stop

@section('content')
    {{-- @include('backend._partials.page_header', [
        'fa' => 'fa fa-list',
        'name' => 'Report Pages',
        'route' => route('backend.siteConfig.slider.index'),
    ]) --}}
    <form action="{{ route('backend.pathology.make-test-result-store') }}" method="post">
        @csrf
        @method('POST')
        <input type="hidden" name="lab_invoice_test_detail_id" value="{{ $data['labDetails_id'] }}">
        <input type="hidden" name="test_id" value="{{ $data['labTest_id'] }}">
        <div class="card">
            <div class="body">
                <h5 class="mb-3">
                    <i class="fa fa-flask"></i> {{ $labTest->category }} Report
                </h5>
                <div class="row mb-2 align-items-center">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'name[]',
                            'value' => $labTest->name,
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'unit[]',
                            'value' => $labTest->unit,
                        ])
                    </div>
                    <div class="col-12 mt-3">
                        @include('components.backend.forms.texteditor.editor', [
                            'name' => 'reference_value[]',
                            'placeholder' => 'reference  here ...',
                            'value' => $labTest->reference_value,

                        ])
                        @include('components.backend.forms.input.errorMessage', [
                            'message' => $errors->first('reference'),
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'name[]',
                            'value' => 'CUS',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'result[]',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'unit[]',
                            'value' => '-',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'reference_value[]',
                            'value' => 'nill',
                        ])
                    </div>

                </div>
                <div class="row text-right">
                    <div class="col-12">
                        <button class="btn btn-primary btn-md" type="submit">Save</button>
                    </div>

                </div>
            </div>
    </form>




@endsection

@push(' js')
@endpush
