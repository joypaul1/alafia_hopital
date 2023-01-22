<div class="card">
    <div class="body">
        <h4 class="pointer text-info" id="toggleFilter">
            <i class="fa fa-filter"></i> Filter
        </h4>
        <div id="filterContainer">
            <hr>
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        @include('components.backend.forms.select2.option',[ 'name' => 'product_type', 'required'=>true, 'optionDatas' => [], ])
                        {{-- @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('product_type')]) --}}
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        @include('components.backend.forms.select2.option',[ 'label' => 'category', 'name' => 'category_id', 'optionDatas' => []])
                        {{-- @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('category')]) --}}
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        @include('components.backend.forms.select2.option',[ 'label' => 'Subcategory', 'name' => 'subcategory_id', 'optionDatas' => [] ])
                        {{-- @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('category')]) --}}
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        @include('components.backend.forms.select2.option',[ 'label' => 'Childcategory', 'name' => 'childcategory_id', 'optionDatas' => [], 'onclick' =>true ])
                        {{-- @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('category')]) --}}
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        @include('components.backend.forms.select2.option',[ 'label' => 'unit',  'name' => 'unit_id', 'required'=>true, 'optionDatas' => [],'onclick' =>true ])
                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('unit_id')])
                    </div>
                </div>
                {{-- <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        @include('components.backend.forms.select2.option',[ 'name' => 'tax', 'required'=>true, 'optionDatas' => [] ])
                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                    </div>
                </div> --}}
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        @include('components.backend.forms.select2.option',[ 'label' => 'brand','name' => 'brand_id', 'required'=>true, 'optionDatas' => [],'onclick' =>true ])
                        {{-- @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('brand_id')]) --}}
                    </div>
                </div>
                {{-- <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        @include('components.backend.forms.select2.option',[ 'name' => 'business_location', 'required'=>true, 'optionDatas' => [] ])
                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                    </div>
                </div> --}}
                <div class="col-lg-6 col-md-6">
                    <div class="d-flex">
                        <div class="form-check mx-4">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                Not for sale
                            </label>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>