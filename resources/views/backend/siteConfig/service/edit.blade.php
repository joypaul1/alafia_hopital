<div class="modal-content">
    <form class="needs-validation" id="service_edit_form" action="{{ route('backend.siteConfig.serviceName.update', $serviceName) }}" method="Post" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <h4 class="title" id="">ServiceName Edit</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'value' => $serviceName->name, 'placeholder' => 'name will be here...', 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.select2.option',['label'=>'Unit', 'name' =>'unit_id', 'optionData'=>$unit , 'selectedKey'=>$serviceName->unit_id,'required'=>true])
                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('unit_id')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.select2.option',['label'=>'serviceName Type', 'name' =>'service_type_id', 'optionData'=>$type, 'selectedKey'=>$serviceName->service_type_id, 'required'=>true])
                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('service_type_id')])
                </div>

                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'service_price', 'placeholder' => 'price will be here...', 'value' => number_format($serviceName->service_price ,2), 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('service_price')])
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="status" {{$serviceName->status == true ? 'Checked': ' '}} id="active_check">
                    <label class="form-check-label" for="active_check">Active ?</label>
                </div>


            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
            <button type="submit" class="btn btn-outline-primary btn-primary edit_service_button">SAVE</button>
        </div>
    </form>
</div>
<script>


</script>
