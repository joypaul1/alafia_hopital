@extends('backend.layout.app')
@push('css')
@endpush
@section('page-header')
    <i class="fa fa-plus-circle"></i> Lab Report
@stop

@section('content')
    <form action="{{ route('backend.radiologyServiceInvoice.make-test-result-store', $radiologyServiceInvoiceItem->id) }}" method="post">
        @csrf
        @method('POST')

        <div class="card">
            <div class="body">
                <h5 class="mb-3">
                    <i class="fa fa-flask"></i> {{ $radiologyServiceInvoiceItem->serviceName->name }} Report
                </h5>
                <div class="row mb-2 align-items-center">

                    <div class="col-12 mt-3">
                        @include('components.backend.forms.texteditor.editor', [
                            'name' => 'result',
                            'placeholder' => 'reference  here ...',
                            'required' => true
                        ])
                        @include('components.backend.forms.input.errorMessage', [
                            'message' => $errors->first('result'),
                        ])
                    </div>
                    <div class="col-12 mt-3">
                        @include('components.backend.forms.select2.option', [
                            'optionData' => $doctors,
                            'name' => 'approved_by',
                            'placeholder' => 'approved by ...',
                            // 'required' => true
                        ])
                        @include('components.backend.forms.input.errorMessage', [
                            'message' => $errors->first('result'),
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
