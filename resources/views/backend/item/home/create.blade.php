@extends('backend.layout.app')
@push('css')
    <style>
        input[type="file"] {
            display: block;
        }

        .imageThumb {
            max-width: 50px;
            max-height: 50px;
            border: 2px solid;
            margin: 10px 10px 0 0;
            padding: 1px;
        }
    </style>
@endpush
@section('page-header')
    <i class="fa fa-plus-circle"></i> Item Create
@stop

@section('content')
    @include('backend._partials.page_header', [
        'fa' => 'fa fa-list',
        'name' => 'Item List',
        'route' => route('backend.itemconfig.item.index'),
    ])

    <div class="row">
        <div class="col-lg-12">
            <form class="needs-validation" action="{{ route('backend.itemconfig.item.store') }}" method="Post"
                enctype="multipart/form-data">
                @method('POST')
                @csrf

                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <div class="mb-3 row">
                                <div class="col-lg-4">
                                    @include('components.backend.forms.input.input-type', [
                                        'name' => 'name',
                                        'placeholder' => 'Product name here...',
                                        'required' => true,
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('name'),
                                    ])
                                </div>
                                <div class="col-lg-4">
                                    @include('components.backend.forms.input.input-type', [
                                        'name' => 'sku',
                                        'placeholder' => 'SKU here...',
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('sku'),
                                    ])
                                    <small class="text-secondary pl-2">Keep this blank to generate SKU automatically</small>
                                </div>

                                <div class="col-lg-4">
                                    @include('components.backend.forms.select2.option', [
                                        'label' => 'unit',
                                        'name' => 'unit_id',
                                        'optionDatas' => [],
                                        'required' => true,
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('unit_id'),
                                    ])
                                </div>
                                <div class="col-lg-4">
                                    @include('components.backend.forms.select2.option', [
                                        'label' => 'Brand',
                                        'name' => 'brand_id',
                                        'optionDatas' => [],
                                        'required' => true,
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('brand_id'),
                                    ])
                                </div>

                                <div class="col-lg-4">
                                    @include('components.backend.forms.select2.option', [
                                        'label' => 'Category',
                                        'name' => 'category_id',
                                        'optionDatas' => [],
                                        'required' => true,
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('category_id'),
                                    ])
                                </div>
                                <div class="col-lg-4">
                                    @include('components.backend.forms.select2.option', [
                                        'label' => 'sub_category',
                                        'name' => 'subcategory_id',
                                        'optionDatas' => [],
                                        'required' => true,
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('subcategory_id'),
                                    ])
                                </div>
                                {{-- <div class="col-lg-4">
                                    @include('components.backend.forms.select2.option', [
                                        'label' => 'child_category',
                                        'name' => 'childcategory_id',
                                        'optionDatas' => [],
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('childcategory_id'),
                                    ])
                                </div> --}}
                                <div class="col-lg-4">
                                    @include('components.backend.forms.select2.option', [
                                        'label' => 'origin',
                                        'name' => 'origin_id',
                                        'optionDatas' => $countries,
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('origin_id'),
                                    ])
                                </div>

                                <div class="col-lg-4">
                                    @include('components.backend.forms.input.input-type', [
                                        'name' => 'alert_quantity',
                                        'placeholder' => 'Product alert quantity here ...',
                                        'number' => true,
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('alert_quantity'),
                                    ])
                                    <small class="text-secondary pl-2">Keep this blank if you don't want to manage
                                        stock.</small>
                                </div>
                                {{-- <div class="col-lg-4">
                                    @include('components.backend.forms.input.input-type', [
                                        'name' => 'weight',
                                        'number' => true,
                                        'placeholder' => 'Weight here ...',
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('weight'),
                                    ])
                                </div> --}}

                                <div class="col-lg-4">
                                    @include('components.backend.forms.select2.option', [
                                        'label' => 'Rack',
                                        'name' => 'rack_id',
                                        'optionDatas' => [],
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('rack_id'),
                                    ])
                                </div>

                                <div class="col-lg-4">
                                    @include('components.backend.forms.select2.option', [
                                        'label' => 'Row',
                                        'name' => 'row_id',
                                        'optionDatas' => [],
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('row_id'),
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <div class="mb-3 row">
                                <div class="col-lg-6">
                                    @include('components.backend.forms.texteditor.editor', [
                                        'name' => 'description',
                                        'placeholder' => 'Product quantity here ...',
                                        'number' => true,
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('description'),
                                    ])
                                </div>
                                <div class="col-lg-6">
                                    @include('components.backend.forms.input.input-image', [
                                        'name' => 'image',
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('image'),
                                    ])
                                    <small class="text-secondary pl-2">
                                        Maximum file size for image is <strong>5 Megabyte</strong> and <strong>500 x 500
                                            pixels
                                        </strong>.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h6>
                            Price and Costs
                        </h6>
                        <div class="form-validation">
                            <div class="mb-3 row">

                                <div class="col-lg-4 pt-2">
                                    @include('components.backend.forms.dropdown.option', [
                                        'label' => 'Applicable Tax Rate',
                                        'name' => 'tax_type',
                                        'optionDatas' => $appilcationTax,
                                        'required' => true,
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('tax_type'),
                                    ])
                                </div>
                                <div class="col-lg-4">
                                    @include('components.backend.forms.dropdown.option', [
                                        'label' => 'Selling Price Tax Type',
                                        'name' => 'tax_id',
                                        'optionDatas' => $taxs,
                                        'required' => true,
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('tax_id'),
                                    ])
                                </div>
                                <div class="col-lg-4">
                                    @include('components.backend.forms.dropdown.option', [
                                        'name' => 'product_type',
                                        'optionDatas' => $product_types,
                                        'required' => true,
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('product_type'),
                                    ])
                                </div>
                            </div>
                        </div>

                        <div class="form-validation">
                            <table class="table table-hover costing_table">
                                <thead style="background-color: #3380FF; color: #fff;">
                                    <tr>
                                        <th scope="col" colspan="3">Default Purchase Price</th>
                                        <th scope="col">Profit Margin (%)</th>
                                        <th scope="col">Default Selling Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>
                                            @include('components.backend.forms.input.input-type', [
                                                'label' => 'Exclusive Tax',
                                                'value' => 0,
                                                'name' => 'exc_tax',
                                                'placeholder' => 'Exc. tax ',
                                                'number' => true,
                                                'required' => true,
                                            ])
                                            @include('components.backend.forms.input.errorMessage', [
                                                'message' => $errors->first('exc_tax'),
                                            ])
                                        </td>
                                        <td>
                                            @include('components.backend.forms.input.input-type', [
                                                'label' => 'Tax Rate',
                                                'value' => 0,
                                                'readonly' => true,
                                                'name' => 'tax_rate',
                                                'placeholder' => 'tax rate ',
                                                'number' => true,
                                                'required' => true,
                                            ])
                                            @include('components.backend.forms.input.errorMessage', [
                                                'message' => $errors->first('tax_rate'),
                                            ])
                                        </td>
                                        <td>
                                            @include('components.backend.forms.input.input-type', [
                                                'label' => 'Inclusive Tax',
                                                'value' => 0,
                                                'name' => 'inc_tax',
                                                'placeholder' => 'Inc. tax',
                                                'number' => true,
                                                'required' => true,
                                            ])
                                            @include('components.backend.forms.input.errorMessage', [
                                                'message' => $errors->first('inc_tax'),
                                            ])
                                        </td>
                                        <td>
                                            @include('components.backend.forms.input.input-type', [
                                                'name' => 'profit_percent',
                                                'value' => 0,
                                                'placeholder' => 'profit (25%)',
                                                'number' => true,
                                                'required' => true,
                                            ])
                                            @include('components.backend.forms.input.errorMessage', [
                                                'message' => $errors->first('profit_percent'),
                                            ])
                                        </td>

                                        <td>
                                            @include('components.backend.forms.input.input-type', [
                                                'name' => 'sell_price',
                                                'value' => 0,
                                                'placeholder' => 'selling price',
                                                'number' => true,
                                                'required' => true,
                                            ])
                                            @include('components.backend.forms.input.errorMessage', [
                                                'message' => $errors->first('sell_price'),
                                            ])
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>






                <div class="row text-right">
                    @include('components.backend.forms.input.submit-button')
                </div>

            </form>
        </div>
    </div>


    @include('backend.item.home.itemJs', [
        'category_id' => null,
        'brand_id' => null,
        'unit_id' => null,
        'rack_id' => null,
    ]);
@endsection
@push('js')
    <script src="{{ asset('applicaiton/item.js') }}"></script>
@endpush
