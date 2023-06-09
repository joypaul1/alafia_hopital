<div class="modal-content">
    <form class="needs-validation" id="service_add_form" action="{{ route('backend.siteConfig.serviceName.store') }}" method="Post" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <h4 class="title" id="">Service Add</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder' => 'name will be here...', 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.select2.option',['label'=>'Unit', 'name' =>'unit_id', 'optionData'=>$unit , 'required'=>true])
                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('unit_id')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.select2.option',['label'=>'Service Type', 'name' =>'service_type_id', 'optionData'=>$type , 'required'=>true])
                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('service_type_id')])
                </div>

                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'service_price', 'placeholder' => 'price will be here...', 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('service_price')])
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="status" checked id="active_check">
                    <label class="form-check-label" for="active_check">Active ?</label>
                </div>


            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
            <button type="submit" class="btn btn-outline-primary save_service_button">SAVE</button>
        </div>
    </form>
</div>
