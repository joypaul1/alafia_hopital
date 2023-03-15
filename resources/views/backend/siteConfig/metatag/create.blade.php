@extends('backend.layout.app')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/dropify/css/dropify.min.css">
<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/font-awesome/css/font-awesome.min.css" />
@endpush
@section('page-header')
<i class="fa fa-plus-circle"></i> SEO Meta-Tag Config
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => ' ',
'route' => route('backend.siteConfig.meta-tag.index')
])


<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="form-validation">
                    <form action="{{ route('backend.siteConfig.meta-tag.store') }}" method="Post" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        @forelse ($metatags as $data)

                        <section class="meta_section mb-1" style="border:1px solid gray;padding:1%">

                            <div class="form-group">

                                @include('components.backend.forms.input.input-type',[ 'name' => 'name[]', 'placeholder' => 'seo type name will be here...', 'value' => $data->name??old('name') ])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])

                            </div>

                            <input type="hidden" name="ids[]" value="{{$data->id}}">

                            <div class="form-group">
                                <textarea class="form-control" name="description[]" id="description" cols="10" rows="5">{{ $data->description??old('description') }}</textarea>
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('description')])
                            </div>

                            <div class="form-group">
                                <div class="col-lg-12 " style="display: block;text-align:right">
                                    <button type="button" class="btn btn-outline-success" id="add">+</button>
                                    <button type="button" class="btn btn-outline-danger" id="delete">-</button>
                                </div>
                            </div>
                        </section>
                        @empty
                              <section class="meta_section mb-1" style="border:1px solid gray;padding:1%">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'name[]', 'placeholder' => 'seo type name will be here...', 'value' => old('name') ])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="description[]" id="description" cols="10" rows="5">{{ old('description') }}</textarea>
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('description')])
                            </div>

                            <div class="form-group">
                                <div class="col-lg-12 " style="display: block;text-align:right">
                                    <button type="button" class="btn btn-outline-success" id="add">+</button>
                                    <button type="button" class="btn btn-outline-danger" id="delete">-</button>
                                </div>
                            </div>
                        </section>
                        @endforelse


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
<script>

    $(document).on('click','#add', function(e){
        e.preventDefault();
        var $clone = $('.meta_section:first').clone().find('[name^="name"],  [name^="description"], [name^="ids"]').val("").end();
        $('.meta_section:last').after($clone);

    })
    $(document).on('click','#delete', function(e){
        e.preventDefault();
        if($('.meta_section').length > 1){
            console.log($('.meta_section').length);
            $(this).closest('.meta_section').remove();
        }else{
            let $context = 'error';
            let $positionClass= 'toast-top-right';
            toastr.remove();
            toastr[$context]("can't remove all section!", '', {
                positionClass: $positionClass
            });
        }

    })

</script>
@endpush
