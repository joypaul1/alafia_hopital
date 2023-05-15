<div class="modal-content">
    <form class="needs-validation" id="service_edit_form" action="{{ route('backend.siteConfig.radiology_serviceName.update', $radiologyServiceName->id) }}" method="PUT" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="modal-header">
            <h4 class="title">Radiology ServiceName Edit</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'value' => $radiologyServiceName->name, 'placeholder' => 'name will be here...', 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.select2.option',[ 'name' => 'department', 'selectedKey' =>$radiologyServiceName->department, 'optionData'=>$departments,'placeholder' => 'department will be here...', 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('department')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'price', 'placeholder' => 'price will be here...', 'value' => number_format($radiologyServiceName->price ,2), 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('price')])
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="status" {{$radiologyServiceName->status == true ? 'Checked': ' '}} id="active_check">
                    <label class="form-check-label" for="active_check">Active ?</label>
                </div>


            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
            <button type="submit" class="btn btn-outline-primary btn-primary">UPDATE</button>
        </div>
    </form>
</div>
<script>


</script>
