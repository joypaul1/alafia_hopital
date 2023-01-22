@extends('backend.layout.app')
@push('css')

@endpush
@section('page-header')
<i class="fa fa-pencil"></i> Size Edit
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Size List',
'route' => route('backend.itemconfig.size.index')
])


<div class="row">
    <div class="col-lg-8">
        <div class="card">

            <div class="card-body">
                <div class="form-validation">
                    <form class="needs-validation" action="{{ route('backend.itemconfig.size.update', $size) }}" method="Post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3 row">
                            <label class="col-lg-4 col-form-label" for="text">Name </label>
                            <div class="col-lg-8">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'value' => old('name',$size->name), 'placeholder' => 'text will be here...' ])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
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
