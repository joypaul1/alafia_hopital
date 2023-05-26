@extends('backend.layout.app')
@push('css')
<style>

</style>
@endpush
@section('page-header')
    <i class="fa fa-plus-circle"></i> Lab Report
@stop

@section('content')
    <div>
        <div class="card">
            <div class="body">
                <h5 class="mb-3">
                    <i class="fa fa-flask"></i> {{ $labTestReport->testName->category ?? '-' }} Report <i class="fa fa-arrow-right" aria-hidden="true"></i> 
                </h5>

                <div class="row text-center">
                    <div class="col-12">
                        <button data-value='growth' class="btn btn-info btn-md growth" type="submit">Growth <i class="fa fa-arrow-down" aria-hidden="true"></i> </button>
                        <button data-value='no_growth' class="btn btn-info btn-md growth" type="submit">No Growth <i class="fa fa-arrow-down" aria-hidden="true"></i> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
    <form action="{{ route('backend.pathology.make-test-result-update',['id' => $labTestReport->id] ) }}" method="post">
        @csrf
        @method('POST')
            <input type="hidden" name="growth" value="Yes">
            {{-- <input type="hidden" name="lab_invoice_test_detail_id" value="{{ $data['labDetails_id'] }}">
            <input type="hidden" name="test_id" value="{{ $data['labTest_id'] }}"> --}}
            <div class="card">
                <div class="body">
                    <h5 class="mb-3">
                        <i class="fa fa-flask"></i> Urine CS Growth
                    </h5>

                    <p class="text-center"> S=Sensitive, R=Resistant, I=Intermediate Sensitive</p>

                    <div class="row mb-2 align-items-center">
                    @forelse (json_decode($labTestReport->result) as $key=>$data)

                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => $data->name,
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            'value' => $data->a,
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            'value' => $data->b,
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            'value' => $data->c,
                            ])
                        </div>
                        @empty
                    @endforelse
                    </div>
                    {{-- <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Amoxyclav',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Amoxycillin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Ampicillin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Aztreonam',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Azithromycin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Cefepime',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Cefixime',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Cefotaxime',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Cefpirome',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Ceftazidime',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Cefuroxime',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Ceftriaxone',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Cephalexin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Cephradine',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Chloramphenicol',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Ciprofloxacin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Cloxacillin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Levofloxacin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Clindamycin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Cotrimoxazole',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Colistin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Doxycycline',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Erythromycin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Nalidexic acid',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Gatifloxacin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Gentamycin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Imipenem',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Mecillinum',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Meropenem',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Neomycin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Netilmicin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Nitrofurantoin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Tazobacpiperacillin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Penicillin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Linezolid',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Tetracycline',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Tigecycline',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Fusidic acid',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Cefoxitin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Cefaclor',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Ceftibuten',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-6">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => 'Vancomycin',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'a[]',
                            'placeholder' => 'Enter result A',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'b[]',
                            'placeholder' => 'Enter result B',
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type2', [
                            'name' => 'c[]',
                            'placeholder' => 'Enter result C',
                            ])
                        </div>
                    </div> --}}
                    <div class="d-block text-right mb-5">
                        <button class="btn btn-lg btn-info">Save</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <div>
        <form action="{{ route('backend.pathology.make-test-result-store') }}" method="post">
            @csrf
            @method('POST')
            <input type="hidden" name="growth" value="No">

            <div class="card">
                <div class="body">
                    <h5 class="mb-3">
                        <i class="fa fa-flask"></i> Urine CS No Growth Report
                    </h5>
                    <div class="row mb-2 align-items-center">


                        <div class="col-12 mt-3">
                            @include('components.backend.forms.texteditor.editor', [
                                'name' => 'reference_value[]',
                                'placeholder' => 'reference  here...',


                            ])
                            @include('components.backend.forms.input.errorMessage', [
                                'message' => $errors->first('reference'),
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
    </div>



@endsection

@push('js')
<script>
  /*  $(document).on('click', '.growth',function () {
        var value = $(this).attr('data-value');
        console.log(value);
        if (value == 'growth') {
            $('#growth').removeClass('d-none');

        }else  {
            $('#growth').addClass('d-none');
        }
        if(value == 'no_growth'){
            $('#no_growth').removeClass('d-none');
        }else{
            $('#no_growth').addClass('d-none');
        }
    });*/
</script>

@endpush
