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
                    <i class="fa fa-flask"></i> {{ $labTest->category ?? 'Prothrombin' }} Report
                </h5>
                <div class="row mb-2 align-items-center">
                @forelse (json_decode($labTestReport->result) as $key=>$result)
                    {{-- @dd($key,$result) --}}
                        <div class="col-3">
                            @include('components.backend.forms.input.input-type', [
                                'name' => 'name[]',
                                'value' => $result->name,
                            ])
                        </div>
                        <div class="col-2">
                            @include('components.backend.forms.input.input-type', [
                                'name' => 'result[]',
                                'value' => $result->result,
                                'placeholder' => 'Enter result here...',
                            ])
                        </div>
                        <div class="col-1">
                            @include('components.backend.forms.input.input-type', [
                                'name' => 'unit[]',
                                'value' => $result->unit,
                            ])
                        </div>

                        <div class="col-6">
                            @include('components.backend.forms.texteditor.editor', [
                                'name' => 'reference_value[]',
                                'value' => $result->reference_value,
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

@push(' js')
@endpush
