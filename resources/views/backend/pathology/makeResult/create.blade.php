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
                            'name' => 'name',
                            'value' => $labTest->name,
                            'readonly' => true,
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'result',
                            'placeholder' => 'Enter result here...',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'unit',
                            'value' => $labTest->unit,
                            'readonly' => true,
                        ])
                    </div>

                    <div class="col-12 mt-3">
                        <label class="col-form-label" for="">Reference Value</label>
                        <textarea class="form-control" name="reference_value" id="" readonly rows="5">{{ $labTest->reference_value }}</textarea>
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
