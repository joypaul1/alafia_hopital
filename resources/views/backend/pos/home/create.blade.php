@extends('backend.layout.app')
@push('css')

@endpush
@section('page-header')
<i class="fa fa-plus-circle"></i> Pos Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Pos List',
'route' => route('backend.pos.index')
])

<div class="row">
    <div class="col-lg-8">
        <div class="card border-top">
            <div class="card-body">
                <div class="form-validation">
                    <form class="needs-validation" action="{{ route('backend.itemconfig.unit.store') }}" method="Post" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">

                            @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder' => 'name will be here...', 'required'=> true ])
                            @include('components.backend.forms.input.errorMessage', ['message' =>  $errors->first('name')])

                        </div>

                        <div class="form-group">
                            @include('components.backend.forms.input.submit-button')
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('js')

@endpush
