
@extends('backend.layout.app')

@section('page-header')
<i class="fa fa-plus-circle"></i> Tax Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 's',
'route' => "#"
])


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="form-validation">
                    <form class="needs-validation" action="{{ route('backend.siteConfig.barcode-method.store') }}" method="Post" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="row align-items-end">

                            <div class="col-md-3">
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option',[ 'name' => 'type','optionData'=>$datas , 'required'=> true ])
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

                                <th>Name</th>
                                <th>Type </th>

                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>QRCODE</td>
                                <td>{!! DNS2D::getBarcodeHTML('Demo_of_QRCODE', 'QRCODE') !!}</td>
                            </tr>
                             {{-- <tr>
                                <td>PHARMA</td>
                                <td>{!! DNS1D::getBarcodeHTML('1111123123sdasdsdaDemo_of_QRCODE', 'PHARMA') !!}</td>
                            </tr> --}}
                            {{-- <tr>
                                <td>PHARMA2T</td>
                                <td>{!! DNS2D::getBarcodeHTML('1Demo_of_PHARMA2T', 'PHARMA2T') !!}</td>
                            </tr> --}}
                            {{-- <tr>
                                <td>CODABAR</td>
                                <td>{!! DNS2D::getBarcodeHTML('11Demo_of_CODABAR', 'CODABAR') !!}</td>
                            </tr> --}}
                            {{-- <tr>
                                <td>KIX</td>
                                <td>{!! DNS2D::getBarcodeHTML('24324', 'KIX') !!}</td>
                            </tr> --}}
                            {{-- <tr>
                                <td>RMS4CC</td>
                                <td>{!! DNS2D::getBarcodeHTML('4445645656', 'RMS4CC') !!}</td>
                            </tr> --}}
                            {{-- <tr>
                                <td>UPCA</td>
                                <td>{!! DNS1D::getBarcodeHTML('4445645656', 'UPCA') !!}</td>
                            </tr>  --}}


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
