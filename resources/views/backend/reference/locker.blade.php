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
        <a href="#defaultModal" data-toggle="modal" data-target="#defaultModal" class="btn btn-info btn-md pull-right">
            <i class="fa fa-plus-circle me-2"></i> Create Project Name
        </a>
    </div>
</div>


<div class="row">
    @forelse ($lockers as $item)
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card">
                <a href="{{ route('backend.admin.locker.document', $item->id) }}" class="folder">
                    <h6><i class="fa fa-folder m-r-10"></i> {{ $item->name??' ' }}</h6>
                </a>
            </div>
        </div>
    @empty
        
    @endforelse
   
</div>


<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('backend.personal-locker.store') }}" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Create Locker Name</h4>
                </div>
                <div class="modal-body"> 
                    <div class="form-validation">
                            @csrf
                            @method('POST')
                            <div class="mb-3 row">
                                <label class="col-lg-2 col-form-label" for="text">Name  <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder' => 'name will be here...', 'required'=> true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('name')])
                                </div>
                            </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">SAVE</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')



@endpush