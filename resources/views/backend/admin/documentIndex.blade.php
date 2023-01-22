@extends('backend.layout.app')
@push('css')


@endpush

@section('page-header')
<i class="fa fa-list"></i> Locker List
@stop
@section('content')

<div class="card d-flex clearfix">
    <div class="header">
        <span href="#" style="font-size: 18px;font-weight:700">
            @yield('page-header')
        </span>
        <a href="{{ route('backend.personal-locker.index') }}" class="btn btn-info btn-md pull-right">
            <i class="fa fa-list me-2"></i>  Locker List
        </a>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body ">
                <form action="{{ route('backend.admin.locker.document.store', $document) }}" method="post">
                    <div class="form-validation">
                        @csrf  @method('POST')
                        <div class="row clearfix mb-2 docsec">
                        @forelse ($document->documents as $key=>$docItem)
                                <div class="col-lg-3 col-md-3">
                                        @include('components.backend.forms.input.input-type',[ 'name' =>'field_1['.$docItem->id.']', 'placeholder' =>
                                        'write here...', 'value'=> \Crypt::decryptString($docItem->field_1??' ')])
                                </div> 
                                <div class="col-lg-3 col-md-3">
                                        @include('components.backend.forms.input.input-type',[ 'name' =>'field_2['.$docItem->id.']', 'placeholder' =>
                                        'write here...', 'value'=> \Crypt::decryptString($docItem->field_2??' ')])
                                </div> 
                                <div class="col-lg-3 col-md-3">
                                        @include('components.backend.forms.input.input-type',[ 'name' =>'field_3['.$docItem->id.']', 'placeholder' =>
                                        'write here...', 'value'=> \Crypt::decryptString($docItem->field_3??' ')])
                                </div> 
                                <div class="col-lg-3 col-md-3">
                                        @include('components.backend.forms.input.input-type',[ 'name' =>'field_4['.$docItem->id.']', 'placeholder' =>
                                        'write here...', 'value'=> \Crypt::decryptString($docItem->field_4??' ')])
                                </div> 
                            @empty
                            @endforelse
                        </div>
                       
                        <div class="row clearfix mb-2 docsec">
                       
                            @forelse ($columns as $key=>$column)
                                <div class="col-lg-3 col-md-3">
                                        @include('components.backend.forms.input.input-type',[ 'name' =>  'new_'.$column.'[]', 'placeholder' =>
                                        'write here...', ])
                                        @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first($column)])
                                </div>
                            @empty
                            @endforelse
                        </div>
                        <div class="col-12 mt-2 text-right ">
                            <button type="button" class="btn btn-sm btn-info addbutton">+</button>
                            <button type="button" class="btn btn-sm btn-danger removeButton">-</button>
                        </div>
                       
                    </div>
                    <div class="col-12 mt-2 text-center">
                        <button type="submit" class="btn btn-success btn-md">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

@push('js')
<script>
    $('.addbutton').click(function(e){
        var  $docsec= $('.docsec');
        var $cloneDocsec= $docsec.last().clone().find("input").val("").end();
        $(".docsec:last").after($cloneDocsec);
    });
    $('.removeButton').click(function(e){
        $(".docsec:last").remove()
    });
</script>


@endpush