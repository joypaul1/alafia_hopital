@extends('backend.layout.app')
@push('css')
@endpush
@section('page-header')
    <i class="fa fa-plus-circle"></i> Lab Report
@stop

@section('content')
<form action="{{ route('backend.pathology.make-test-result-update',['id' => $labTestReport->id] ) }}" method="post">
        @csrf
        @method('POST')
       
        <div class="card">
            <div class="body">
                <h5 class="mb-3">
                    <i class="fa fa-flask"></i> {{ $labTest->category ?? 'BT,CT' }} Report
                </h5>
                <div class="row mb-2 align-items-center">
                @forelse (json_decode($labTestReport->result) as $key=>$result)

<div class="col-4">
    @include('components.backend.forms.input.input-type', [
        'name' => 'name[]',
        'value' => $result->name,
        'required' => true,
        'readonly' => true,
    ])
</div>
<div class="col-4">
    @include('components.backend.forms.input.input-type', [
        'name' => 'result[]',
        'required' => true,
        'value' => $result->result,
    ])
</div>


<div class="col-12 mt-3">
    @include('components.backend.forms.texteditor.editor', [
        'name' => 'reference_value[]',
        'placeholder' => 'reference  here ...',
        'value' => $result->reference_value,

    ])
    @include('components.backend.forms.input.errorMessage', [
        'message' => $errors->first('reference'),
    ])
</div>
@empty
@endforelse

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

