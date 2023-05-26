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
                <h5 class="mb-3">
                    <i class="fa fa-flask"></i> Urine Routine Test
                </h5>
                <h6 class="mt-4 mb-3">
                    PHYSICAL EXAMINATION
                </h6>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Quantity',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Colour',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Appearance',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Sediment',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Speciﬁc gravity',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <h6 class="mt-4 mb-3">
                    CHEMICAL EXAMINATION
                </h6>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Reaction',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Excess phosphate',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Albumin',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Sugar(Reducing substances)',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => '* Ketone Bodies',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => '* Bile salts',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => '* Bile pigment',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => '* Urobilinogen',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <h6 class="mt-4 mb-3">
                    MICROSCOPIC EXAMINATION
                </h6>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Epithelial Cells',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'RBC',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Pus cells',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Cellular casts',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Granular cast',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Hyaline cast',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Calcium oxalate',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Triple phosphare',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Uric Acid',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Urates',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Amorphous phosphate',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
                        ])
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'name[]',
                        'value' => 'Trichomonasvaginalis',
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                        'name' => 'result[]',
                        'placeholder' => 'Enter result here...',
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
