<div class="modal-content">
    <form class="needs-validation" id="labTestTube_edit_form" action="{{ route('backend.siteConfig.labTestName.update', $labTestName) }}" method="Post" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <h4 class="title" id="">LabTest Edit</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'value' => $labTestName->name, 'placeholder' => 'name will be here...', 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.select2.option',['label'=>'labTestName Type', 'name' =>'labTestTube_type_id', 'optionDatas'=>$type, 'selectedKey'=>$labTestName->labTestTube_type_id, 'required'=>true])
                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('labTestTube_type_id')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'labTestTube_price', 'placeholder' => 'price will be here...', 'value' => number_format($labTestName->labTestTube_price ,2), 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('labTestTube_price')])
                </div>
                <div class=" form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3">{{$labTestName->description??' '}}</textarea>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="status" {{$labTestName->status == true ? 'Checked': ' '}} id="active_check">
                    <label class="form-check-label" for="active_check">Active ?</label>
                </div>


            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary edit_labTestTube_button">SAVE</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
        </div>
    </form>
</div>
<script>


</script>
