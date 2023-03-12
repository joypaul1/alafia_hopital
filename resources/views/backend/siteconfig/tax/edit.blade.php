@extends('backend.layout.app')

@section('page-header')
<i class="fa fa-plus-circle"></i> Tax Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => ' ',
'route' => "#"
])


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="form-validation">
                    <form class="needs-validation" action="{{ route('backend.siteConfig.tax-rate.store') }}" method="Post" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="row align-items-end">
                            <div class="col-md-3">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder' => 'Standard Tax', 'required' =>true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'rate', 'number'=> true, 'required' =>true,'placeholder' => 'Enter Tax Rate (eg. 5% or 10%)'])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('rate')])
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'type','optionDatas'=>$datas, 'required'=> true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('type')])
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    @include('components.backend.forms.input.submit-button')
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table
                        class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Name</th>
                                <th>Rate </th>
                                <th>Type </th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                           @forelse ($taxDatas as $key=>$item)

                           <td>{{ $key+1 }}</td>
                           <td>{{ $item->name??'-' }}</td>
                           <td>{{ $item->rate??'-' }}</td>
                           <td>{{ $item->type??'-' }}</td>
                           <td>
                            <a href="{{ route('backend.siteConfig.tax-rate.edit', $item) }}" class="btn btn-sm btn-icon btn-warning  m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i>
                            </a>
                            <button   type="button"  onclick="delete_check({{$item->id}})"
                            class="btn btn-sm btn-icon btn-danger  button-remove" data-toggle="tooltip" data-original-title="Remove" aria-describedby="tooltip64483"><i class="icon-trash" aria-hidden="true"></i>
                            </button >
                            <form action="{{ route('backend.siteConfig.tax-rate.destroy', $item)}}"
                                id="deleteCheck_{{ $item->id }}" method="POST">
                                @method('delete')
                              @csrf
                          </form>
                        </td>
                           @empty

                           @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@include('backend._partials.delete_alert')
