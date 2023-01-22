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
'route' => route('backend.itemconfig.item.index')
])

<div class="row">
    <div class="col-lg-12">
        <form class="needs-validation" action="{{ route('backend.itemconfig.item.update',$item ) }}" method="Post" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="card">
                <div class="card-body">
                    <div class="form-validation">
                        <div class="mb-3 row">
                            <div class="col-lg-4">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder'
                                => 'Product name here...', 'required'=> true, 'value' => $item->name ])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('name')])
                            </div>
                            <div class="col-lg-4">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'sku','value' => $item->sku , 'placeholder' =>'SKU here...'])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('sku')])
                                <small class="text-secondary pl-2">Keep this blank to generate SKU automatically</small>
                            </div>

                            <div class="col-lg-4">
                                @include('components.backend.forms.select2.option',[ 'label' =>'unit', 'selectedKey' => $item->unit_id,'name' => 'unit_id','optionDatas'=>[], 'required'=> true ])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('unit_id')])
                            </div>
                            <div class="col-lg-4">
                                @include('components.backend.forms.select2.option',['label' =>'Brand','selectedKey' => $item->brand_id, 'name' => 'brand_id','optionDatas'=>[], 'required'=> true ])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('brand_id')])
                            </div>

                            <div class="col-lg-4">
                                @include('components.backend.forms.select2.option',[ 'label' =>'Category','selectedKey' => $item->category_id, 'name' => 'category_id','optionDatas'=>[], 'required'=> true ])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('category_id')])
                            </div>
                            <div class="col-lg-4">
                                @include('components.backend.forms.select2.option',[ 'label' =>'sub_category',  'name' => 'subcategory_id','optionDatas'=>$subcategories,'selectedKey'=>$item->subcategory_id , 'required'=> true ])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('subcategory_id')])
                            </div>
                            <div class="col-lg-4">
                                @include('components.backend.forms.select2.option',[ 'label' =>'child_category',  'name' => 'childcategory_id', 'optionDatas'=>$childcategories,'selectedKey'=>$item->childcategory_id , ])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('childcategory_id')])
                            </div>
                            <div class="col-lg-4">
                                @include('components.backend.forms.select2.option',[ 'label' => 'origin', 'name' => 'origin_id','selectedKey' => $item->origin_id, 'optionDatas'=>$countries, ])
                                @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('origin_id')])
                            </div>

                            <div class="col-lg-4">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'alert_quantity','selectedKey' => $item->alert_quantity, 'placeholder' => 'Product alert quantity here ...', 'number'=> true ])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('alert_quantity')])
                                <small class="text-secondary pl-2">Keep this blank if you don't want to manage stock.</small>
                            </div>
                            <div class="col-lg-4">
                                @include('components.backend.forms.input.input-type',[ 'name' => 'weight', 'number'=>true , 'selectedKey' => $item->weight, 'placeholder' => 'Weight here ...' ])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('weight')])
                            </div>

                            <div class="col-lg-4">
                                @include('components.backend.forms.select2.option',[ 'label' => 'Rack', 'name' => 'rack_id','optionDatas'=>[],])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('rack_id')])
                            </div>

                            <div class="col-lg-4">
                                @include('components.backend.forms.select2.option',[ 'label' => 'Row',  'name' => 'row_id', 'optionDatas'=>[]])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('row_id')])
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
                                @include('components.backend.forms.texteditor.editor',[ 'name' => 'description',

                                'placeholder'=> 'Product quantity here ...', 'number'=> true ])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('description')])
                            </div>
                            <div class="col-lg-6">
                                @include('components.backend.forms.input.input-image',[ 'name' => 'image' ])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('image')])
                                <small class="text-secondary pl-2">
                                    Maximum file size for image is <strong>5 Megabyte</strong> and <strong>500 x 500 pixels
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
                                @include('components.backend.forms.dropdown.option',[ 'label'=>'Applicable Tax Rate' ,
                                'selectedKey' => $item->tax_type,
                                'name' => 'tax_type','optionDatas'=>$appilcationTax, 'required'=> true ])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('tax_type')])
                            </div>
                            <div class="col-lg-4">
                                @include('components.backend.forms.dropdown.option',[ 'label' =>'Selling Price Tax Type','name' => 'tax_id',
                                'selectedKey' => $item->tax_id,
                                'optionDatas'=>$taxs, 'required'=> true ])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('tax_id')])
                            </div>
                            <div class="col-lg-4">
                                @include('components.backend.forms.dropdown.option',[ 'name' => 'product_type',
                                'selectedKey' => $item->product_type,
                                'optionDatas'=>$product_types, 'required'=> true ])
                                @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('product_type')])
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
                                        @include('components.backend.forms.input.input-type',['label' =>'Exclusive Tax',
                                        'value'=> round($item->up_before_tax,2), 'name' => 'exc_tax', 'placeholder' => 'Exc. tax ', 'number' => true, 'required'=> true ])
                                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('exc_tax')])
                                    </td>
                                    <td>
                                        @include('components.backend.forms.input.input-type',['label' =>'Tax Rate','value'=> number_format($item->tax_rate,2), 'readonly'=>true,'name' => 'tax_rate',
                                        'placeholder' => 'tax rate ', 'number' => true, 'required'=> true ])
                                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('tax_rate')])
                                    </td>
                                    <td>
                                        @include('components.backend.forms.input.input-type',[ 'label' => 'Inclusive Tax','value'=>number_format($item->up_after_tax,2),
                                        'name'=>'inc_tax', 'placeholder' => 'Inc. tax','number' => true, 'required'=> true ])
                                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('inc_tax')])
                                    </td>
                                    <td>
                                        @include('components.backend.forms.input.input-type',[ 'name' => 'profit_percent','value'=> number_format($item->profit_percent,2), 'placeholder' => 'profit (25%)', 'number' => true, 'required'=> true ])
                                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('profit_percent')])
                                    </td>

                                    <td>
                                        @include('components.backend.forms.input.input-type',[ 'name' => 'sell_price','value'=>number_format($item->sell_price,2), 'placeholder' => 'selling price', 'number' => true, 'required'=> true ])
                                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('sell_price')])
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <h6>
                        Products Image Gallery
                    </h6>
                    <div class="form-validation">
                        <table class="table table-bordered galleryImage">
                            <thead>
                                <tr>
                                    <th scope="col">Gallery Name</th>
                                    <th scope="col">Images</th>
                                    <th scope="col">Is Thumbnail ?</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="additional_products">
                                <tr>
                                    <td>
                                        <input type="text" name="galleryName[0]" placeholder="gallery Name" class="form-control">
                                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('galleryName')])

                                    </td>
                                    <td>
                                        <div class="field" align="left">
                                            <span>
                                                <input type="file" id="files" name="galleryImage[0][]" multiple />
                                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('galleryImage')])

                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-control"  id="is_thumbnail" value="{{ 'off' }}" name="is_thumbnail[]">
                                    </td>
                                    <td class='text-danger h5'><i class="fa fa-trash galleryRowDelete" style="cursor: pointer ;" aria-hidden="true"></i></td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="text-right">
                            <span class="btn btn-secondary" id="add_gallery">Add Another</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h6>
                        Add product specifications (e.g. Model, Manufacturer, etc.)
                    </h6>
                    <div class="form-validation">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Attribute Name</th>
                                    <th scope="col">Attribute Value</th>
                                    <th scope="col">Active ?</th>
                                    <th scope="col">Order</th>
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>
                            <tbody id="product_attribute">
                                <tr>
                                    <th>
                                        <input type="text" name="attribute_name[]"  placeholder="Attribute Name" class="form-control">
                                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('attribute_name')])

                                    </th>
                                    <td>
                                        <input type="text"  name="attribute_value[]"  placeholder="Attribute Value" class="form-control">
                                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('attribute_value')])

                                    </td>
                                    <td><input type="checkbox" name="attribute_status[]" class="form-control"></td>
                                    <td><input type="number" name="attribute_serial_number[]" class="form-control"></td>
                                    <td class="text-center"><i class="fa fa-minus-circle deleteAttribute" style='cursor: pointer;' aria-hidden="true"></i></td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="text-right">
                            <span class="btn btn-secondary" id="add_attribute">Add new Attribute</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    @include('components.backend.forms.texteditor.editor',[ 'name' =>'provide_product_specific_delivery_information', 'placeholder' => 'Provide product specific delivery information here ...', ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('provide_product_specific_delivery_information')])
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h6>
                        Provide search engine optimization (SEO) information here
                    </h6>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'meta_title', 'placeholder' =>'Meta title here...' ])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('meta_title')])
                        </div>
                        <div class="col-lg-4 col-md-6">
                            @include('components.backend.forms.input.input-type',[ 'name' =>'meta_keywords', 'placeholder' => 'Meta Keywords here...' ])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('meta_keywords')])</div>
                        <div class="col-lg-4 col-md-6">
                            <label class="col-form-label" for="meta-description">Meta Description</label>
                            <textarea name="meta_description" class="form-control" id="meta-description" rows="2"></textarea>
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('meta_description')])</div>

                        </div>
                    </div>
                </div>
            </div>


            @include('components.backend.forms.input.submit-button')


        </form>
    </div>
</div>


@include('backend.item.home.itemJs',['category_id' => $item->category_id, 'brand_id'=> $item->brand_id,
'unit_id' =>$item->unit_id, 'rack_id' => $item->rack_id
] );
@endsection
@push('js')

<script src="{{ asset('applicaiton/item.js')}}"></script>

@endpush



