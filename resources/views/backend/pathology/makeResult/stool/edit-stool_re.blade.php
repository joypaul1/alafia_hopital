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
                    <i class="fa fa-flask"></i> Stool Routine Test
                </h5>
                @forelse (json_decode($labTestReport->result) as $key=>$result)

                <div class="row mb-2 align-items-center">
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'name[]',
                            'value' => $result->name,
                        ])
                    </div>
                    <div class="col-6">
                        @include('components.backend.forms.input.input-type2', [
                            'name' => 'result[]',
                            'placeholder' => 'Enter result here...',
                            'value' => $result->result,
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
