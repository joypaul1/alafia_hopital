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
        <input type="hidden" name="growth"  value="No">
        <div class="card">
            <div class="body">
                <h5 class="mb-3">
                    <i class="fa fa-flask"></i> {{ $labTestReport->testName->category }} Report
                </h5>
                <div class="row mb-2 align-items-center">
@php 
$result=json_decode($labTestReport->result)

@endphp


                    <div class="col-12 mt-3">
                        @include('components.backend.forms.texteditor.editor', [
                            'name' => 'reference_value[]',
                            'placeholder' => 'reference  here...',
                            'value' =>$result[0],


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




@endsection

@push(' js')
@endpush
