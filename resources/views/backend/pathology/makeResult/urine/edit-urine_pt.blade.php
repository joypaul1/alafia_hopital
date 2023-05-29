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
                    <i class="fa fa-flask"></i> Pregnancy Test (PT) Report
                </h5>
                @forelse (json_decode($labTestReport->result) as $key=>$result)

                <div class="row mb-2 align-items-center">
                    <div class="col-3">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'name[]',
                            'value' => $result->name,
                            'required' => true,

                        ])
                    </div>
                    <div class="col-3">
                        @include('components.backend.forms.select2.option', [
                            'label' => 'result',
                            'name' => 'result[]',
                            'required' => true,
                            'value' => $result->result,

                           // 'optionData' => (object)[['id'=>'True', 'name' => 'True'], ['id'=>'False', 'name' => 'False']],
                        ])
                    </div>
                    <div class="col-3">
                        @include('components.backend.forms.input.input-type', [
                            'label' => 'Reference Value',
                            'name' => 'reference_value[]',
                            'value' => $result->reference_value,
                            'required' => true,

                        ])
                    </div>

                </div>
                @empty
@endforelse
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
