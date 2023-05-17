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
                    <i class="fa fa-flask"></i> Stool Routine Test
                </h5>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Quantity sent',
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
                            'value' => 'Consistency',
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
                            'value' => 'Odour',
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
                            'value' => 'Blood',
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
                    CHMICAL EXAMINTION
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
                            'value' => 'Reducing substance',
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
                    MICROSCOPIC EXAMINTION
                </h6>
                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Vegetable cells',
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
                            'value' => 'Epithelial cells',
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
                            'value' => 'Giardia lamdlia',
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
                            'value' => 'Cysts of',
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
                            'value' => 'E. histolytica',
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
                            'value' => 'E. coli',
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
                            'value' => 'Giardia lamdlia',
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
                            'value' => 'Ova of',
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
                            'value' => 'AscarisLumbricoides',
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
                            'value' => 'Ankytostimaduodenale',
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
                            'value' => 'Enteroviusvemicularis',
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
                            'value' => 'TrichuristrichiruaHymenolepis nana',
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
                            'value' => 'Macrophages',
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
                            'value' => 'Fat Globules',
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
                            'value' => 'Muscle Fibers',
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
                            'value' => 'Starch Granular',
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
                            'value' => 'Charcot Leyden crystals',
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
                            'value' => 'Mucus',
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
                            'value' => 'Yeast Cells',
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
