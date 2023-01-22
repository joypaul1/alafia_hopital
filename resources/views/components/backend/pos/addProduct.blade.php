<div class="form-validation">
    <div class="mb-3 row">
        <div class="col-lg-4">
            @include('components.backend.forms.input.input-type',[ 'name' => 'Product Name', 'placeholder' => 'Product name here...', 'required'=> true ])
            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
        </div>
        <div class="col-lg-4">
            @include('components.backend.forms.input.input-type',[ 'name' => 'SKU', 'placeholder' => 'SKU here...'])
            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
            <small class="text-secondary pl-2">Keep this blank to generate SKU automatically </small>
        </div>
        <div class="col-lg-4">
            @include('components.backend.forms.select2.option',[ 'name' => 'Barcode Type', 'optionDatas'=>[], 'required'=> true ])
            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
        </div>
        <div class="col-lg-4">
            @include('components.backend.forms.select2.option',[ 'name' => 'Units', 'optionDatas'=>[], 'required'=> true ])
            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
        </div>
        <div class="col-lg-4">
            @include('components.backend.forms.select2.option',[ 'name' => 'Brand', 'optionDatas'=>[], 'required'=> true ])
            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
        </div>
        <div class="col-lg-4">
            @include('components.backend.forms.select2.option',[ 'name' => 'Category', 'optionDatas'=>[], 'required'=> true ])
            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
        </div>
        <div class="col-lg-4">
            @include('components.backend.forms.select2.option',[ 'name' => 'Sub Category', 'optionDatas'=>[], 'required'=> true ])
            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
        </div>
        <div class="col-lg-4">
            @include('components.backend.forms.select2.option',[ 'name' => 'Business Locations', 'optionDatas'=>[], 'required'=> true ])
            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
            <small class="text-secondary pl-2">Location where products will be available.</small>
        </div>
        <div class="col-lg-4">
            @include('components.backend.forms.input.input-type',[ 'name' => 'Quantity', 'placeholder' => 'Product quantity here ...', 'number'=> true ])
            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
            <small class="text-secondary pl-2">Keep this blank if you don't want to manage stock.</small>
        </div>
        <div class="col-lg-6">
            @include('components.backend.forms.texteditor.editor',[ 'name' => 'description', 'placeholder' => 'Product quantity here ...', 'number'=> true ])
            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
        </div>
        <div class="col-lg-6">
            @include('components.backend.forms.input.input-image',[ 'name' => 'Product Image' ])
            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
            <small class="text-secondary pl-2">
                Maximum file size for image is <strong>5 Megabyte</strong> and <strong>500 x 500 pixels </strong>.
            </small>
        </div>
    </div>
</div>

<div class="form-validation">
    <div class="mb-3 row">
        <div class="col-lg-4">
            @include('components.backend.forms.input.input-type',[ 'name' => 'Weight', 'placeholder' => 'Weight here ...' ])
            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
        </div>
        <div class="col-lg-4">
            @include('components.backend.forms.input.input-type',[ 'name' => 'Rac', 'placeholder' => 'Rac here ...' ])
            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
        </div>
        <div class="col-lg-4">
            @include('components.backend.forms.input.input-type',[ 'name' => 'Row', 'placeholder' => 'Row Number here ...' ])
            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
        </div>
    </div>
</div>

<h6>
    Price and Costs
</h6>
<div class="form-validation">
    <div class="mb-3 row">

        <div class="col-lg-4">
            <label class="col-form-label mt-2" for="cost_price">
                Cost price
            </label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">BDT</span>
                </div>
                <input type="text" class="form-control" id="cost_price" placeholder="Enter Cost" name="cost">
            </div>
        </div>
        <div class="col-lg-4">
            <label class="col-form-label mt-2" for="selling_price">
                Selling price
            </label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">BDT</span>
                </div>
                <input type="text" class="form-control" id="selling_price" placeholder="Enter Price" name="selling_price">
            </div>
        </div>
        <div class="col-lg-4 pt-2">
            @include('components.backend.forms.select2.option',[ 'name' => 'Applicable Tax Rate', 'optionDatas'=>[], 'required'=> true ])
            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
        </div>
        <div class="col-lg-4">
            @include('components.backend.forms.select2.option',[ 'name' => 'Selling Price Tax Type', 'optionDatas'=>[], 'required'=> true ])
            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
        </div>
        <div class="col-lg-4">
            @include('components.backend.forms.select2.option',[ 'name' => 'Product Type', 'optionDatas'=>[], 'required'=> true ])
            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
        </div>
    </div>
</div>

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
                    <input type="text" placeholder="Attribute Name" class="form-control">
                </th>
                <td><input type="text" placeholder="Attribute Value" class="form-control"></td>
                <td><input type="checkbox" class="form-control"></td>
                <td><input type="number"></td>
                <td class="text-center"><i class="fa fa-minus-circle" style='cursor: pointer;' aria-hidden="true"></i></td>
            </tr>
        </tbody>
    </table>
    <p class="text-right">
        <span class="btn btn-secondary" id="add_attribute">Add new Attribute</span>
    </p>
</div>

<div class="form-validation">
    <table class="table table-hover">
        <thead style="background-color: #5CB85C; color: #fff;">
            <tr>
                <th scope="col" colspan="2">Default Purchase Price</th>
                <th scope="col">Default Selling Price</th>
                <th scope="col">Product Image</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>
                    @include('components.backend.forms.input.input-type',[ 'name' => 'Exc. tax', 'placeholder' => 'Exc. tax ', 'required'=> true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </th>
                <th>
                    @include('components.backend.forms.input.input-type',[ 'name' => 'Inc. tax', 'placeholder' => 'Inc. tax', 'required'=> true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </th>
                <th>
                    @include('components.backend.forms.input.input-type',[ 'name' => 'Exc. tax', 'placeholder' => 'Exc. tax ', 'required'=> true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </th>
                <td>
                    <label for="product_image">
                        <input id="product_image" name="product_image" type="file">
                    </label>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@include('components.backend.forms.texteditor.editor',[ 'name' => 'provide_product_specific_delivery_information', 'placeholder' => 'Provide product specific delivery information here ...', ])
@include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])


<h6>
    Provide search engine optimization (SEO) information here
</h6>
<div class="row">
    <div class="col-lg-4 col-md-6">
        @include('components.backend.forms.input.input-type',[ 'name' => 'meta_title', 'placeholder' => 'Meta title here...' ])
        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
    </div>
    <div class="col-lg-4 col-md-6">@include('components.backend.forms.input.input-type',[ 'name' => 'meta_keywords', 'placeholder' => 'Meta Keywords here...' ])
        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])</div>
    <div class="col-lg-4 col-md-6">
        <label class="col-form-label" for="meta-description">Meta Description</label>
        <textarea name="meta-description" class="form-control" id="meta-description" rows="2"></textarea>
    </div>
</div>

<h6>
    Additional products.
</h6>
<div class="form-validation">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Images</th>
                <th scope="col">Is Thumbnail ?</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="additional_products">
            <tr>
                <td>
                    <input type="text" placeholder="Product Name" class="form-control">
                </td>
                <td>
                    <div class="field" align="left">
                        <span>
                            <input type="file" id="files" name="files[]" multiple />
                        </span>
                    </div>
                </td>
                <td><input type="checkbox" class="form-control"></td>
                <td class='text-danger h5'><i class="fa fa-trash" style="cursor: pointer ;" aria-hidden="true"></i></td>
            </tr>
        </tbody>
    </table>
    <p class="text-right">
        <span class="btn btn-secondary" id="add_additional_products">Add Another</span>
    </p>
</div>