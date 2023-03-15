@extends('backend.layout.app')


@section('page-header')
    <i class="fa fa-list"></i> Slider List
@stop
@section('content')

@include('backend._partials.page_header', [
    'fa' => 'fa fa-plus-circle',
    'name' => 'Create Slider',
    'route' => route('backend.siteConfig.slider.create')
 ])


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table
                        {{-- class="table table-bordered table-striped table-hover dataTable js-exportable"> --}}
                        class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sl.</th>
                                {{-- <th class="text-center">Text</th> --}}
                                <th class="text-center">Image</th>
                                <th class="text-center">Position</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($sliders as $key=>$item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    {{-- <td>{{ $item->text??'-' }}</td> --}}
                                    <td><img src="{{ asset( $item->image) }}" alt="{{ $item->image }}" srcset="" width="100%" height="100"></td>
                                    <td>{{ $item->position??'-'}}</td>
                                    <td>
                                        <a href="{{ route('backend.siteConfig.slider.edit', $item) }}" class="btn btn-sm btn-icon btn-warning  m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i>
                                        </a>
                                        <button   type="button"  onclick="delete_check({{$item->id}})"
                                        class="btn btn-sm btn-icon btn-danger  button-remove" data-toggle="tooltip" data-original-title="Remove" aria-describedby="tooltip64483"><i class="icon-trash" aria-hidden="true"></i>
                                        </button >
                                        <form action="{{ route('backend.siteConfig.slider.destroy', $item)}}"
                                            id="deleteCheck_{{ $item->id }}" method="POST">
                                            @method('delete')
                                          @csrf
                                      </form>
                                    </td>
                                </tr>
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

